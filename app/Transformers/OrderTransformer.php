<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Order;
class OrderTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['items','orderDates'];
    public function transform(Order $order)
    {
        return [
            'id'=>$order->id,
            'status' => $order->status,
            'note' => $order->note,
            'total_price' => $order->total_price,
            'dispute_comment' => $order->dispute_comment,
            'total_price_after_discount' => $order->total_price_after_discount,
            'address'=>$order->address,

        ];
    }

    public function includeItems(Order $order)
    {
        if($order->items){
            return $this->collection($order->items,new OrderItemsTransformer);
        }
    }

    public function includeOrderDates(Order $order)
    {
        if($order->orderDates){
            return $this->collection($order->orderDates,new OrderDateTransformer);
        }
    }



}
