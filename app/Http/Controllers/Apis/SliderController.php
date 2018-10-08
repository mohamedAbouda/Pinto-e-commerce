<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Transformers\SliderTransformer;


class SliderController extends Controller
{
	public function allSliders()
	{
		$sliders = Slider::all();
		return response()->json(
			fractal()
			->collection($sliders)
			->transformWith(new SliderTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
		,200);
	}
}
