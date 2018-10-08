<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Color;
class ProductColorTransformer extends TransformerAbstract
{
    public function transform(Color $color)
    {
        return [
            'id'=>$color->id,
            'name' => $color->name,
            'code' => $color->code,
        ];
    }

}
