<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\OrderDate;
class OrderDateTransformer extends TransformerAbstract
{
    public function transform(OrderDate $orderDate)
    {
        return [
            'id'=>$orderDate->id,
            'date_from' => $orderDate->date_from,
            'date_to' => $orderDate->date_to,
        ];
    }

}
