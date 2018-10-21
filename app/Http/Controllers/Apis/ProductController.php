<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\SimpleProductTransformer;
use App\Transformers\ProductTransformer;
use App\Models\Product;
use App\Models\Review;


class ProductController extends Controller
{
	public function featuredProducts()
	{
		$featuredProducts = Product::where('featured',1)->get();
		return response()->json(
			fractal()
			->collection($featuredProducts)
			->transformWith(new SimpleProductTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
	}

	public function popularProducts()
	{
		$popularProducts = Product::orderBy('views','DESC')->get();
		return response()->json(
			fractal()
			->collection($popularProducts)
			->transformWith(new SimpleProductTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
	}

	public function categoryProducts(Request $request)
	{
		if(!$request->input('sub_category_id')){
			return response()->json([
				'error' => 'Please provide the sub category id'
			],404);
		}
		$categoryProducts = Product::where('sub_category_id',$request->input('sub_category_id'))->get();
		return response()->json(
			fractal()
			->collection($categoryProducts)
			->transformWith(new SimpleProductTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
	}

	public function productDetails(Request $request)
	{
		$product = Product::where('id',$request->input('product_id'))->first();
		return response()->json(
			fractal()
			->item($product)
			->transformWith(new ProductTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
	}

	public function addProductReview(Request $request)
	{
		if(!$request->input('review')){
			return response()->json([
				'error' => 'Please provide the review'
			],404);
		}
		$data = $request->all();
		$data['client_id'] = $request->user()->id;
		$data['approved'] = 1;
		$review = Review::create($data);
		return response()->json([
			'success' => 'review added successfully',
		],200);
	}

	public function searchProducts(Request $request)
	{
		$products = Product::where('id','!=',null);
		if($request->input('product_name')){
			$products->where('name','like','%'.$request->input('product_name').'%');
		}
		$products = $products->get();
		return response()->json(
			fractal()
			->collection($products)
			->transformWith(new SimpleProductTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
	}
}
