<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\OrderCheckoutRequest;
use Cart;
use App\Models\Product;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\GiftCard;
use App\Models\DeliveryOption;
use App\Models\Notification;
use App\Models\Stock;
use App\Models\RedeemedGift;
use App\Models\PaymentMethod;
use App\Models\CorporateDeal;
use App\Models\Order;
use App\Models\Address;
use App\Models\AddressClient;
use App\Models\Cart as DbCart;
use App\Mail\OrderInvoiceEmail;
use Mail;
use App\Models\OrderProduct;
use App\Http\Requests\Web\CheckoutSubmitRequest;
use Session;
use Auth;
use Alert;

class CartController extends Controller
{
    public function index()
    {
    
        $count = Cart::content()->count();
        if($count > 0){
            $data['cart'] = Cart::content();
            $data['total'] = Cart::subtotal();
            return view('site.cart.index' , $data);
        }else{
            Alert::error('No items in your cart', 'Oops!')->persistent('Close');
            return redirect()->back();

        }

    }
    /**
    * \
    * @param Request $request
    * @param
    */
    public function addToCart(Request $request,Product $product)
    {
        $data = $request->all();
        $price = 0;
        $stockSum = Stock::where('product_id',$request->input('id'))->sum('amount');
        $productOrdersSum = OrderProduct::where('product_id',$request->input('id'))->sum('amount');
        $availableItems = $stockSum - $productOrdersSum;
        if($data['qty'] > $availableItems){
            return ['message'=>'Not Available Amount.','cartSubTotal'=>0,'cartItem'=>0,'CartCount'=>0];
        }
        $product = Product::where('id',$request->input('id'))->with('discount')->first();
        $price = $product->price;
        if($product->discount){
            $discountPrice = ($product->price * $product->discount->percentage)/100;
            $price = $product->price - $discountPrice;
        }
        $item = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->input('qty'),
            'price' =>$price,
            'options' => [
                'obj' => $product,
                'color' => $request->input('color' , NULL),
                'size' => $request->input('size' , NULL),
            ]
        ]);
        return ['message'=>'Item Added to Cart.','cartSubTotal'=>Cart::subtotal(),'cartItem'=>$item,'CartCount'=>Cart::content()->count()];
    }



    public function updateQtyItem(Request $request)
    {
        $data = $request->all();
        $update = Cart::update($data['rowId'], $request->input('qty'));
        $total = Cart::subtotal();
        return [Cart::get($data['rowId']),$total];
    }
    public function removeItem(Request $request)
    {
        $data = $request->all();
        Cart::remove($data['rowId']);
        $total = Cart::subtotal();
        $count = Cart::content()->count();
        return [$data['rowId'],$total,$count];
    }

    public function AddCouponAndSave(Request $request)
    {
        $data = $request->all();
        $message = '';
        $checkGiftCard = GiftCard::where('code',$request->input('code'))->first();
        if($checkGiftCard){
            if($checkGiftCard->is_active == 1){
                if($checkGiftCard->discount < 1){
                    $message = 'You will get discount by '.($checkGiftCard->discount*100).' % on the products by code\'s merchant ';
                }else{
                    $message = 'You will get discount by '.$checkGiftCard->discount.' EGP on the products by code\'s merchant ';
                }
                
                    Session::forget('giftCardId');
                    Session::put(['giftCardId'=>$checkGiftCard->id]);                
            }else{
                $message = 'This Gift card is not active';
            }
        }else{
            $message = 'There are no gift card with this code.';
        }
        return $message;
    }


    public function checkout()
    {

        $count = Cart::content()->count();
        if($count > 0){
            $productIds = [];
            $CorporateDealsProducts = [];
            $string = '';
            $total = 0;
            $cartSubTotal = 0;
            foreach(Cart::content() as $item){
                array_push($productIds, $item->options->obj->id);
            }
            $CorporateDeals = CorporateDeal::whereIn('first_product_id',$productIds)->whereIn('second_product_id',$productIds)->where('approved',1)->with('firstProduct','secondProduct')->get();
            foreach($CorporateDeals as $CorporateDeal){
                if(!in_array($CorporateDeal->first_product_id, $CorporateDealsProducts) && !in_array($CorporateDeal->second_product_id, $CorporateDealsProducts)){
                   $itemQtyFirstProduct = Cart::search(function ($cart, $key) use($CorporateDeal) {
                    return $cart->id == $CorporateDeal->firstProduct->id;
                    })->pluck('qty')->first();
                   $itemQtySecondProduct = Cart::search(function ($cart, $key) use($CorporateDeal) {
                    return $cart->id == $CorporateDeal->secondProduct->id;
                    })->pluck('qty')->first();
                    $discountFirstProduct = ($CorporateDeal->firstProduct->price * $itemQtyFirstProduct) - ($CorporateDeal->discount*$itemQtyFirstProduct);
                    $discountSecondProduct = ($CorporateDeal->secondProduct->price * $itemQtySecondProduct) - ($CorporateDeal->discount*$itemQtySecondProduct);
                    $total += $discountFirstProduct;
                    $total += $discountSecondProduct;
                    $string .= 'You have discount '.$CorporateDeal->discount.' EGP on product '.$CorporateDeal->firstProduct->name.' according to corporate deal with other product its total price after discount is '.$discountFirstProduct.' EGP<br>';
                    $string .=  'You have discount '.$CorporateDeal->discount.' EGP on product '.$CorporateDeal->secondProduct->name.' according to corporate deal with other product its total price after discount is '.$discountSecondProduct.' EGP<br>';
                    array_push($CorporateDealsProducts, $CorporateDeal->first_product_id,$CorporateDeal->second_product_id);
                }
            }

            $productsDiscounts = Product::whereIn('id',$productIds)->whereNotIn('id',$CorporateDealsProducts)->with('discount')->get();
            foreach($productsDiscounts as $productDiscount){
                if($productDiscount->discount){
                    $itemQtyProduct = Cart::search(function ($cart, $key) use($productDiscount) {
                    return $cart->id == $productDiscount->id;
                    })->pluck('qty')->first();
                     $productAfterPriceDiscount = ($productDiscount->price * $itemQtyProduct) - (($productDiscount->discount->percentage * $productDiscount->price) /100);
                    $string .= 'you have offer discount '.$productDiscount->discount->percentage.' % on the product '.$productDiscount->name.' its total price after the offer is '.$productAfterPriceDiscount.'EGP<br>';
                    $total +=$productAfterPriceDiscount;
                    array_push($CorporateDealsProducts, $productDiscount->id);
                }
            }
            if(Session::has('giftCardId')){
                if(Session::get('giftCardId') != null){
                    $giftCard = GiftCard::where('id',Session::get('giftCardId'))->first();
                    $productsGiftCards = Product::whereIn('id',$productIds)->whereNotIn('id',$CorporateDealsProducts)->with('discount')->get();
                   foreach($productsGiftCards as $productGiftCards){
                        if($giftCard->merchant_id == $productGiftCards->merchant_id){
                            $giftCardQtyProduct = Cart::search(function ($cart, $key) use($productGiftCards) {
                                return $cart->id == $productGiftCards->id;
                            })->pluck('qty')->first();
                            if($giftCard->discount < 1){
                                $discountGiftCard = ($productGiftCards->price * $giftCardQtyProduct) - ((($giftCard->discount * 100) * $productGiftCards->price) /100);
                                $total += $discountGiftCard;
                                $string .= 'you have discount on product '.$productGiftCards->name.' due to gift card its total price after discount is '.$discountGiftCard.' EGP';
                            }else{
                                $discountGiftCard = ($productGiftCards->price * $giftCardQtyProduct) - ($giftCard->discount*$giftCardQtyProduct);
                                $total += $discountGiftCard;
                                $string .= 'you have discount on product '.$productGiftCards->name.' due to gift card its total price after discount is '.$discountGiftCard.' EGP';
                            }
                        }
                    }
                }
            }
            if($total == 0){
                $total = Cart::subtotal();
            }
            $cartItems = Cart::content();
            $cartSubTotal = Cart::subtotal();
            return view('site.cart.checkout',compact('total','CorporateDealsProducts','cartItems','cartSubTotal','string'));
        }else{
            Alert::error('No items in your cart', 'Oops!')->persistent('Close');
            return redirect()->back();
        }
    }

    public function checkoutSubmit(CheckoutSubmitRequest $request)
    {
        $data = $request->all();
        $data['status'] = 2;
        $data['client_id'] = $data['user_id'] = Auth::guard('client')->user()->id;
        if(Session::has('giftCardId')){
            if(Session::get('giftCardId') != null){
                $data['gift_card_id'] = Session::get('giftCardId');
            }
        }

        $createOrder = Order::create($data);
        foreach(Cart::content() as $cartItem){
            $createOrderProduct = new OrderProduct;
            $createOrderProduct->product_id = $cartItem->id;
            $createOrderProduct->amount = $cartItem->qty;
            $createOrderProduct->price_per_item = $cartItem->options->obj->price;
            $createOrderProduct->color = $cartItem->options->color ? $cartItem->options->color : null; 
            $createOrderProduct->size = $cartItem->options->size ? $cartItem->options->size : null; 
            $createOrderProduct->order_id = $createOrder->id;
            $createOrderProduct->save(); 
        }

        if($request->input('address')){
            $createAddress = Address::create($data);
            $data['address_id'] = $createAddress->id;
            $createClientAddress = AddressClient::create($data);
        }
        Session::forget('giftCardId');
        Cart::destroy();
         Alert::success('Your order has been placed', 'Done')->persistent('Close');
            return redirect()->route('index');
    }

    public function removeItemRow(Request $request)
    {

        if(Auth::guard('client')->check()){
            $checkOrder = Order::where('user_id',Auth::guard('client')->id())->where('status',1)->first();
            if($checkOrder){
                foreach ($checkOrder->items as $item) {
                    if($item->product_id == $request->input('productId')){
                        $item->delete();
                    }
                }
            }
        }
        $data = $request->all();
        Cart::remove($data['rowId']);
        $total = Cart::subtotal();
        return ['rowId'=>$data['rowId'],'cartSubTotal'=>Cart::subtotal(),'CartCount'=>Cart::content()->count()];
    }
    public function checkQuantity(Request $request)
    {
        $data = $request->all();
        $stockSum = Stock::where('product_id',$data['id'])->sum('amount');
        $productOrdersSum = OrderProduct::where('product_id',$data['id'])->sum('amount');
        $availableItems = $stockSum - $productOrdersSum;
        if($data['qty'] > $availableItems){
            return 'stockSumNotAvailable';
        }
    }
    public function destroy()
    {
        Cart::destroy();
        return redirect()->route('index');
    }


}
