<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Tag;
class ProductTagTransformer extends TransformerAbstract
{
    public function transform(Tag $tag)
    {
        return [
            'id'=>$tag->id,
            'name' => $tag->name,
        ];
    }

}
