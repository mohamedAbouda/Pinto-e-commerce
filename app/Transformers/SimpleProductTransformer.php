<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Product;
class SimpleProductTransformer extends TransformerAbstract
{
   // protected $defaultIncludes = ['KeyWord'];
    public function transform(Product $product)
    {
        return [
            'id'=>$product->id,
            'name' => $product->name,
            'description' => $product->description,
            'image' => $product->cover_image_url,
            'short_description' => $product->short_description,
            'rate'=>$product->rate,
        ];
    }

  /*  public function includeKeyWord(Product $product)
    {
        if($product->keyWord){
            return $this->item($product->keyWord,new KeyWordTransformer);
        }
    }*/

}
