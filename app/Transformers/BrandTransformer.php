<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Brand;
class BrandTransformer extends TransformerAbstract
{
    public function transform(Brand $brand)
    {
        return [
            'id'=>$brand->id,
            'name' => $brand->name,
            'image' => $brand->image_url,
        ];
    }

}
