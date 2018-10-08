<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ProductImage;
class ProductImageTransformer extends TransformerAbstract
{
    public function transform(ProductImage $image)
    {
        return [
            'id'=>$image->id,
            'image' => $image->image_url,
        ];
    }

}
