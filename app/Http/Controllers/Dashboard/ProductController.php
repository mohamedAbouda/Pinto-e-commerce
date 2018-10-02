<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\ProductStoreRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Merchant;
use App\Models\Stock;
use App\Models\DiscountProduct;
use App\Models\Product;
use App\Models\GeneralProduct;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Auth;

class ProductController extends BaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $input = $request->all();
        $query = Product::with('stocks');

        if($request->has('from') && $request->has('to')){
            if($input['from'] > $input['to']){
                alert()->error('start Date should be less than end date.' , 'Error')->persistent("Close This");
            }
        }
        if ($request->has('from')) {
            $query = $query->where('created_at' ,'>=' ,$input['from']);
        }
        if ($request->has('to')) {
            $query = $query->where('created_at' ,'<=' ,$input['to']);
        }
        $data['products'] = $query->paginate(20);

        return view('dashboardV2.products.index' ,$data);
    }

    public function approvedProducts()
    {
        $products = Product::where('approved',1)->paginate(20);
        return view('dashboardV2.products.approvedProducts', compact('products'));
    }

    public function disapprovedProducts()
    {
        $products = Product::where('approved',0)->paginate(20);
        return view('dashboardV2.products.disApprovedProducts', compact('products'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $categories = Category::with('subCategories')->get();
        $subcategories = SubCategory::pluck('name','id')->toArray();
        $sizes = Size::all();
        $colors = Color::all();
        $brands = Brand::all();
        return view('dashboardV2.products.create', compact('subcategories','categories', 'sizes', 'colors' , 'brands'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->all();
        $data['featured'] = 1;

        if ($product = Product::create($data)) {
            $data['product_id'] = $product->id;
            $createGeneralProduct = GeneralProduct::create($data);

            $productId = $product->id;
            $brands = Brand::all();
            $subCategory = SubCategory::where('id',$request->input('sub_category_id'))->with('category')->first();
            return view('dashboardV2.products.createInventory',compact('productId','brands','subCategory'));
        }
        return back()->with('info', 'Product did not create.');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        if ($product = Product::where('id',$id)->with('sizes','colors','images','generalProduct','keyWord','discountCount')->first()) {

            $categories = Category::with('subCategories')->get();
            $subcategories = SubCategory::pluck('name','id')->toArray();
            $sizes = Size::all();
            $colors = Color::all();
            $brands = Brand::all();
            $subCategory = SubCategory::where('id',$product->sub_category_id)->first();
            $productIds = GeneralProduct::where('product_id',$id)->pluck('related_products')->first();
            $relatedProductIds = explode(',', $productIds);
            $relatedProducts = Product::whereIn('id',$relatedProductIds)->get();
            $productsRelated = Product::get();

            return view('dashboardV2.products.edit', compact('product', 'subcategories', 'categories', 'sizes', 'colors' ,'brands','relatedProductIds','productsRelated','subCategory'));
        }
        return back()->with('info', 'Item did not found in database.');
    }

    public function show($id)
    {
        if ($product = Product::where('id',$id)->with('sizes','colors','subcategory','brand','stocks','GeneralProduct','discountCount')->first()) {
            return view('dashboardV2.products.show', compact('product'));
        }
        return back()->with('info', 'Item did not found in database.');
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = Product::find($id);
        $stock = Stock::where('product_id',$id)->first();
        $generalProduct = GeneralProduct::where('product_id',$id)->first();
        if($product->keyWord){
            $count = 0;
            $myArray = explode(',', $request->input('text'));
            $categoryKeys = explode(',', $product->subcategory->category->keyWord->text);
            foreach ($myArray as $key) {
                if(in_array($key, $categoryKeys)){
                    $count++;
                }
            }
            if($count >= round(count($myArray)/4)){
                $product->update(['match_keys'=>1]);
            }else{
                $product->update(['match_keys'=>0]);
            }
            $keyWord = $product->keyWord->update($data);

        }else {
            $key_word = $product->keyWord()->create([
                'text' => $data['text']
            ]);
            $data['key_word_id'] = $key_word->id;
        }
        if($stock){
            $stock->update($data);
        }
        if($generalProduct){
            $generalProduct->update($data);
        }
        $productIds = $request->input('product_ids');
        if($request->input('product_ids')){
            $comma_separated = implode(",", $productIds);
            $createRelatedProducts = GeneralProduct::where('product_id',$id)->update([
                'related_products'=>$comma_separated,
            ]);
        }else{
            $createRelatedProducts = GeneralProduct::where('product_id',$id)->update([
                'related_products'=>'',
            ]);
        }

        if($request->input('shipping_merchant') && $request->input('shipping_cost')){
            $shippingMerchantCost = GeneralProduct::where('product_id',$id)->first();
            $shippingMerchantCost->update($data);
        }

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $productImage = ProductImage::create([
                    'product_id'=>$id,
                    'image'=>$image,
                ]);
            }

        }


        if ($product->update($data)) {

            return redirect('dashboard/products/index')->with('success', 'Item updated.');
        }
        return back()->with('info', 'Item did not update.');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        if ($product = Product::find($id)) {
            $product->delete();
            return redirect()->route('dashboard.products.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }

    public function subCategories()
    {
        $category_id = request()->get('category_id' , NULL);
        if (!$category_id) {
            return response()->json([]);
        }
        $resource;
        if (request()->has('product_id')) {
            $resource = Product::find(request()->get('product_id'));
        }
        $subcategories = SubCategory::where('category_id' , $category_id)
        ->pluck('name','id')->toArray();
        $html = view('dashboardV2.products.parts.subcategories',compact('subcategories' , 'resource'))->render();
        return response()->json([
            'obj' => $subcategories,
            'html' => $html
        ]);
    }

    public function changeFeaturedStatus(Request $request)
    {
        $updateProduct=Product::where('id',$request->input('product_id'))->update([
            'featured'=>$request->input('featured'),
        ]);
        return redirect()->back();
    }

    public function featuredProductsRequests()
    {
        $products = Product::whereNotIn('featured',[1])->paginate(20);
        return view('dashboardV2.products.featuredProducts', compact('products'));
    }
    public function changeFeaturedStatusAjax(Request $request)
    {
        $updateProduct=Product::where('id',$request->input('product_id'))->update([
            'featured'=>$request->input('featured'),
        ]);

        return $product = Product::where('id',$request->input('product_id'))->first();
    }
    public function reviews($id)
    {
        $reviews = Review::where('product_id',$id)->with('client')->get();
        $avg =  Review::where('product_id',$id)->avg('rate');
        return view('dashboardV2.products.reviews', compact('reviews','avg'));
    }

    public function deleteReview(Request $request)
    {
        $removeReview = Review::where('id',$request->input('review_id'))->delete();
        return $request->input('review_id');
    }
    public function addStock($id)
    {
        return view('dashboardV2.products.addStock')->with('id',$id);
    }

    public function removeStock($id)
    {
        return view('dashboardV2.products.removeStocks')->with('id',$id);
    }

    public function saveStock(Request $request)
    {
        $data = $request->all();
        if($data['value'] == 'negative'){
            $data['amount'] = -$data['amount'];
        }
        $stock = Stock::create($data);
        return redirect(route('dashboard.products.index'));
    }

    public function deleteImage(Request $request)
    {
        $deleteImage = ProductImage::where('id',$request->input('id'))->delete();
        return $request->input('id');
    }

    public function saveInventory(Request $request)
    {
        $data = $request->all();
        $createStock = Stock::create($data);
        return $stock = Stock::where('id',$createStock->id)->with('product')->first();

    }

    public function deleteInventory(Request $request)
    {
        $deleteStock = Stock::where('id',$request->input('id'))->delete();
        return $request->input('id');
    }

    public function shippingPage(Request $request)
    {
        $productId = $request->input('product_id');
        return view('dashboardV2.products.shippingPage',compact('productId'));
    }

    public function storeShippingPage(Request $request)
    {
        $data = $request->all();
        if($request->input('shipping_merchant') && $request->input('shipping_cost')){
            $shippingMerchantCost = GeneralProduct::where('product_id',$request->input('product_id'))->first();
            $shippingMerchantCost->update($data);
        }
        $products = Product::get();

        return view('dashboardV2.products.relatedProducts')->with(['productId'=>$request->input('product_id'),'products'=>$products]);
    }

    public function storeRelatedProducts(Request $request)
    {
        $productIds = $request->input('product_ids');
        if($request->input('product_ids')){
            $comma_separated = implode(",", $productIds);
            $createRelatedProducts = GeneralProduct::where('product_id',$request->input('product_id'))->update([
                'related_products'=>$comma_separated,
            ]);
        }
        $productId = $request->input('product_id');
        return view('dashboardV2.products.keyWords',compact('productId'));
    }

    public function storeProductImages(Request $request)
    {
        $data = $request->all();
        $product = Product::where('id',$request->input('product_id'))->first();
        $product->update($data);
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $productImage = ProductImage::create([
                    'product_id'=>$request->input('product_id'),
                    'image'=>$image,
                ]);
            }

        }
        $productId = $request->input('product_id');
        return view('dashboardV2.products.discount',compact('productId'));
    }

    public function checkProductSection(Request $request)
    {
        return  $section = Category::where('id',$request->input('id'))->first();
    }

    public function changeSubCategoryAjax(Request $request)
    {
        return $sub_categories = SubCategory::where('category_id',$request->input('id'))->get();
    }

    public function DiscountProductAdd(Request $request)
    {
        $data = $request->all();
        $create = DiscountProduct::create($data);
        return $data = DiscountProduct::where('id',$create->id)->with('product')->first();
    }

    public function DiscountProductDelete(Request $request)
    {
        $data = $request->all();
        $delete = DiscountProduct::where('id',$data['id'])->delete();
        return $data['id'];
    }

    public function toggleApprove(Request $request)
    {
        $id = $request->input('product_id');
        $product = Product::where('id',$id)->first();
        if($product->approved == 1){
            $product->update(['approved'=>0]);
        }else{
            $product->update(['approved'=>1]);
        }

        return redirect()->back();
    }

    public function toggleStatus(Request $request)
    {
        $checkStatus = Review::where('id',$request->input('review_id'))->first();
        if($checkStatus->approved == 0){
            $checkStatus->update(['approved'=>1]);
        }else{
            $checkStatus->update(['approved'=>0]);
        }

        return redirect()->back();
    }

    public function updateReview(Request $request)
    {
        $data = $request->all();
        $update = Review::where('id',$request->input('review_id'))->first();
        $update->update($data);
        return redirect()->back();
    }

    public function approvedReviews()
    {
        $reviews = Review::where('approved',1)->with('product','client')->paginate(10);
        return view('dashboardV2.reviews.index',compact('reviews'));
    }

    public function disapprovedReviews()
    {
        $reviews = Review::where('approved',0)->with('product','client')->paginate(10);
        return view('dashboardV2.reviews.index',compact('reviews'));
    }

    public function withCorrelationProducts(Request $request)
    {
        $input = $request->all();
        $query = Product::with('stocks')->where('match_keys',1);

        if ($request->has('from')) {
            $query = $query->where('created_at' ,'>=' ,$input['from']);
        }
        if ($request->has('to')) {
            $query = $query->where('created_at' ,'<=' ,$input['to']);
        }
        $data['products'] = $query->paginate(20);

        return view('dashboardV2.products.index' ,$data);
    }

    public function withoutCorrelationProducts(Request $request)
    {
        $input = $request->all();
        $query = Product::with('stocks')->where('match_keys',0);

        if ($request->has('from')) {
            $query = $query->where('created_at' ,'>=' ,$input['from']);
        }
        if ($request->has('to')) {
            $query = $query->where('created_at' ,'<=' ,$input['to']);
        }
        $data['products'] = $query->paginate(20);

        return view('dashboardV2.products.index' ,$data);
    }
}
