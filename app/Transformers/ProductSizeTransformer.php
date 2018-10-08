<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Size;
class ProductSizeTransformer extends TransformerAbstract
{
    public function transform(Size $size)
    {
        return [
            'id'=>$size->id,
            'name' => $size->name,
        ];
    }

}
