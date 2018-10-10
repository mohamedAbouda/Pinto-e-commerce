<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\OrderCheckoutRequest;
use App\Http\Requests\Web\CheckoutSubmitRequest;
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
use App\Models\OrderProduct;
use App\Models\ShippingMethod;
use Session;
use Alert;
use Cart;
use Mail;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        $count = Cart::content()->count();
        if($count > 0){
            /**
            * Cart data is shared in Controller.php
            */
            $data['shipping_methods'] = ShippingMethod::get();
            return view('site.cart.index' ,$data);
        }
        Alert::error('No items in your cart', 'Oops!')->persistent('Close');
        return redirect()->back();
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
        if($request->get('qty' ,1) > $availableItems){
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
            'qty' => $request->get('qty' ,1),
            'price' =>$price,
            'options' => [
                'obj' => $product,
                'color' => $request->input('color' , NULL),
                'size' => $request->input('size' , NULL),
            ]
        ]);

        return response()->json([
            'message' => 'Item Added to Cart.',
            'side_bar_cart' => view('layouts.site.parts.cart')->render(),
            'cartSubTotal' => Cart::subtotal(),
            'cartItem' => $item,
            'CartCount' => Cart::content()->count()
        ]);
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


    public function updateCart(Request $request)
    {
        $input = $request->all();

        //update el cart
        Cart::destroy();
        foreach ($input['cart'] as $item) {
            $cart_row = json_decode($item);
            Cart::add([
                'id' => $cart_row->id,
                'name' => $cart_row->name,
                'qty' => $cart_row->qty,
                'price' => $cart_row->price,
                'options' => [
                    'obj' => $cart_row->options->obj,
                    'color' => $cart_row->options->color,
                    'size' => $cart_row->options->size,
                ]
            ]);
        }

        if ($request->get('shipping_method')) {
            $request->session()->put('shipping_method', $input['shipping_method']);
        }

        return response()->json([
            'status' => 'success',
            'redirectTo' => route('web.cart.checkout')
        ]);
    }

    public function checkout(Request $request)
    {
        $count = Cart::content()->count();
        if($count > 0){
            /**
            * Cart data is shared in Controller.php
            */
            $data['shipping_methods'] = ShippingMethod::get();
            $data['countries'] = Country::get();
            if ($addresses = auth()->guard('client')->user()->addresses) {
                $data['addresses'] = $addresses;
                $data['client'] = auth()->guard('client')->user();
            }
            return view('site.cart.checkout' ,$data);
        }
        Alert::error('No items in your cart', 'Oops!')->persistent('Close');
        return redirect()->back();
    }

    public function checkoutSubmit(CheckoutSubmitRequest $request)
    {
        $data = $request->all();

        if (!$request->get('shipping_method')) {
            alert()->error('Please select an shipping method.', 'Error');
            return redirect()->back();
        }
        if (!$request->get('new_address') && (!$request->get('address_id') || !is_numeric($request->get('address_id')))) {
            alert()->error('Please select an address or add a new one.', 'Error');
            return redirect()->back();
        }

        $data['status'] = 2;
        $data['client_id'] = $data['user_id'] = Auth::guard('client')->user()->id;

        if($request->get('new_address')){
            $createAddress = Address::create($data);
            $data['address_id'] = $createAddress->id;
            $createClientAddress = AddressClient::create($data);
        }else{
            $data['address_id'] = $request->get('address_id');
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
