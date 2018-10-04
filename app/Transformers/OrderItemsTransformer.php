<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\OrderProduct;
class OrderItemsTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['product'];
    public function transform(OrderProduct $orderProduct)
    {
        return [
            'id'=>$orderProduct->id,
            'amount' => $orderProduct->amount,
            'price_per_item' => $orderProduct->price_per_item,

        ];
    }

    public function includeProduct(OrderProduct $orderProduct)
    {
        if($orderProduct->product){
            return $this->item($orderProduct->product,new SimpleProductTransformer);
        }
    }

}
