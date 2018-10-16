<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\OrderDisputeComment;
class DisputeTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['client'];
	public function transform(OrderDisputeComment $dispute)
	{
		return [
			'id'=>$dispute->id,
			'dispute_comment' => $dispute->dispute_comment,
		];
	}


	public function includeClient(OrderDisputeComment $dispute)
	{
		if($dispute->client){
			return $this->item($dispute->client,new SimpleClientTransformer);
		}
	}

}
