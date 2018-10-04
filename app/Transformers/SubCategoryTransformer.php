<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\SubCategory;
class SubCategoryTransformer extends TransformerAbstract
{
    //protected $defaultIncludes = ['category'];
    public function transform(SubCategory $subCategory)
    {
        return [
            'id'=>$subCategory->id,
            'name' => $subCategory->name,
            'icon' => $subCategory->icon,
            'tags' => $subCategory->tags,
       

        ];
    }

    /*public function includeCategory(SubCategory $subCategory)
    {
        if($subCategory->category){
            return $this->item($subCategory->category,new CategoryTransformer);
        }
    }*/

}
