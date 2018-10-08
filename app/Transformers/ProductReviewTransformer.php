<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Review;
class ProductReviewTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['client'];
	public function transform(Review $review)
	{
		return [
			'id'=>$review->id,
			'review'=>$review->review,
			'name'=>$review->name,
			'rate'=>$review->rate,
			'approved'=>$review->approved,
		];
	}

	public function includeClient(Review $review)
	{
		if($review->client){
			return $this->item($review->client,new ClientTransformer);
		}
	}

}
