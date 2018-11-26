<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProductReviewRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Color;
use App\Models\Review;
use App\Models\Discount;
use App\Models\SubCategory;
use App\Models\Size;
use Carbon\Carbon;
use Auth;
use DB;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $data['resources'] = Product::where('id','<>',NULL);

        if ($request->has('search')) {
            $data['resources'] = $data['resources']->where('name' , 'LIKE' , '%'.$request->get('search').'%')
            ->orWhere('description' , 'LIKE' , '%'.$request->get('search').'%');
        }
        if ($request->has('catId')) {
            $data['resources'] = $data['resources']->where('category_id' , $request->get('catId'));
            $data['category'] = Category::find($request->get('catId'));
        }
        if(!$request->has('search') && !$request->has('catId')){
            $data['resources'] = Product::paginate(20);
        }else{
            $data['resources'] = $data['resources']->paginate(20);
        }

        return view('web.product.index',$data);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $product =  Product::where('id',$id)->with('subcategory.category','keyWord','images')->first();
        $data['product'] = $product;
        $data['discount'] = Discount::where('activation_end' ,'>=' ,Carbon::now()->toDateTimeString())->where('activation_start' ,'<=' ,Carbon::now()->toDateTimeString())->where('product_id',$product->id)->where('active',1)->first();
        $data['reviews_count'] = $product->reviews ? $product->reviews->count() : 0;
        $data['reviews'] = $product->reviews ? $product->reviews->take(5) : 0;
        $data['reviews_avg'] = count($product->reviews) >=1 ? $product->reviews->avg('rate') : 0;
        $data['related_products'] = Product::where('id' ,'<>',$product->id)
        ->where('sub_category_id' , $product->sub_category_id)->orderBy('id' , 'DESC')
        ->take(12)->get();
        $data['sizes'] = Stock::where('product_id',$id)->pluck('size');
        $data['colors'] = Stock::where('product_id',$id)->pluck('color');
        $stockCount = $product->stocks->sum('amount');
        $ordersCount = $product->orderProducts->sum('amount');
        $availableItems = $stockCount - $ordersCount;
        if($availableItems > 0){
            $data['availability'] = 'yes';
        }else{
            $data['availability'] = 'no';
        }
        //return $data;

        $product->views = $product->views + 1;
        $product->save();
        //
        //     $data['resource'] = $product;
        //
        //     $data['related_products'] = Product::where('id' ,'<>',$product->id)
        //     ->where('sub_category_id' , $product->sub_category_id)->orderBy('id' , 'DESC')
        //     ->take(5)->get();
        //     $data['discounts'] = Product::whereHas('discount',function($q){
        //     $q->where('activation_end' ,'>=' ,Carbon::now()->toDateTimeString())->where('activation_start' ,'<=' ,Carbon::now()->toDateTimeString());
        // })->take(8)->get();

        return view('site.product' , $data);
    }

    public function review(ProductReviewRequest $request , Product $product)
    {
        if(Auth::guard('client')->check()){
            $input = $request->all();
            $input['product_id'] = $product->id;

            $input['client_id'] = Auth::guard('client')->user()->id;

            $review = Review::create($input);

            alert()->success('Thanks of taking part in reviewing this product.', 'Success');
            return redirect()->back();
        }else{
            alert()->error('Please Login to Write a review.', 'Error');
            return redirect()->back();
        }
    }

    public function reviews(Request $request ,Product $product)
    {
        $index = $request->get('index' ,1);
        if ($product->reviews()->count() < 5) {
            return response()->json([
                'html' => '',
                'next_page' => 1,
            ]);
        }
        $offset = 5 * $index - 5;
        $data['reviews'] = $product->reviews ? $product->reviews()->skip($offset)->take(5)->get() : [];
        $html = view('site.single-product.reviews' ,$data)->render();

        return response()->json([
            'html' => $html,
            'next_page' => ($index+1),
        ]);
    }

    public function getSearchPage(Request $request)
    {
        // $banners = Banner::where('active' ,1)->where('position' ,'LIKE' ,'%Search page%')->inRandomOrder()->get();
        // $data['banner_top'] = $banners->filter(function ($item) {
        //     return strpos($item->position ,'Search page top') !== FALSE;
        // })->first();
        // $data['banners_side'] = $banners->filter(function ($item) {
        //     return strpos($item->position ,'Search page sidebar') !== FALSE;
        // });
        return view('site.search');
    }


    public function getSearchPageData()
    {
        $data['sizes'] = Size::get();
        $data['colors'] = Color::get();
        $data['brands'] = Brand::get();
        foreach ($data['brands'] as $brand) {
            $brand->products_count  = Stock::where('brand_id' ,$brand->id)->groupBy('product_id')->count();
        }
        $data['sections'] = Category::with('subCategories')->get();
        foreach ($data['sections'] as $section) {
            $sub_categories = $section->subCategories()->pluck('id')->toArray();
            $section->products_count  = Product::whereIn('sub_category_id' ,$sub_categories)->count();
        }

        return response()->json($data);
    }

    public function search(Request $request)
    {
        $search_sql = Product::where('products.id' ,'<>' ,NULL);

        if ($section_id = $request->get('section_id')) {
            $sub_categories = SubCategory::where('category_id' ,$section_id)->pluck('id')->toArray();
            $search_sql = $search_sql->whereIn('sub_category_id' ,$sub_categories);
        }elseif ($request->get('sub_category_id')) {
            $sub_category_id = $request->get('sub_category_id');
            $search_sql = $search_sql->where('sub_category_id' ,'=' ,$sub_category_id);
        }

        if ($request->has('price_from')) {
            $price_from = $request->get('price_from');
            $search_sql = $search_sql->where('price' ,'>=' ,$price_from);
        }

        if ($request->has('price_to')) {
            $price_to = $request->get('price_to');
            $search_sql = $search_sql->where('price' ,'<=' ,$price_to);
        }

        if ($request->has('brand_id')) {
            $brand_id = $request->get('brand_id');
            $search_sql = $search_sql->whereHas('stocks' ,function($q) use($brand_id){
                $q->where('brand_id' ,$brand_id);
            });
        }
        //
        if ($request->has('size_id')) {
            $size = Size::find($request->get('size_id'));
            $search_sql = $search_sql->whereHas('stocks' ,function($q) use($size){
                //match for $size where after can be a ",[XL,L,XXL,X]"
                //and before "[XL,L,XXL,X],"
                $q->where('size' ,'REGEXP' ,"^([A-Za-z],?)*" . $size->name . "(,?[A-Za-z])*$");
            });
        }
        //
        if ($request->has('color_id')) {
            $color = Color::find($request->get('color_id'));
            $search_sql = $search_sql->whereHas('stocks' ,function($q) use($color){
                $q->where('color' ,'REGEXP' ,"^([A-Za-z],?)*" . $color->name . "(,?[A-Za-z])*$");
            });
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $search_sql = $search_sql->where(function($q) use($search){
                $q->where('name' ,'LIKE' ,'%' . $search . '%')
                ->orWhere('short_description' ,'LIKE' ,'%' . $search . '%');
            });
        }

        if ($request->has('sort')) {
            switch ($request->get('sort')) {
                case 'popularity':
                $search_sql = $search_sql->orderBy('views','DESC');
                break;
                case 'price_low_high':
                $search_sql = $search_sql->orderBy('price','ASC');
                break;
                case 'price_high_low':
                $search_sql = $search_sql->orderBy('price','DESC');
                break;
                case 'top_deals':
                $search_sql = $search_sql->select('products.*' ,'discount_products.discount')
                ->leftJoin('discount_products' ,'discount_products.product_id' ,'=' ,'products.id')
                ->orderBy('discount','DESC')
                ->orderBy('products.id','DESC');
                break;
                case 'newest':
                default:
                $search_sql = $search_sql->orderBy('id','DESC');
            }
        }else {
            $search_sql = $search_sql->orderBy('id','DESC');
        }

        $products = $search_sql->with(['subCategory','discount','reviews'])->paginate($request->get('paginate_by' ,12));
        foreach($products as $product){
            $product->reviews_avg = $product->reviews ? $product->reviews->avg('rate') : 0;
        }

        return $products;
    }
}
