<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Transformers\CategoryTransformer;

class CategoryController extends Controller
{
	public function allCategories(Request $request)
	{
		$categories = Category::all();
		return response()->json(
			fractal()
			->collection($categories)
			->transformWith(new CategoryTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
	}
}
