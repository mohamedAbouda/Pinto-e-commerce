<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Category;
class CategoryTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['KeyWord','subCategories'];
    public function transform(Category $category)
    {
        return [
            'id'=>$category->id,
            'name' => $category->name,
            'icon' => $category->icon,
            'unicode' =>$category->unicode,
            'image' => $category->image_url,
            'navBar' => $category->navBar,
            'payment_withhold' => $category->payment_withhold,
            'payment_due_percentage' => $category->payment_due_percentage,
            'shipping_cost' => $category->shipping_cost,

        ];
    }

    public function includeKeyWord(Category $category)
    {
        if($category->keyWord){
            return $this->item($category->keyWord,new KeyWordTransformer);
        }
    }
    public function includeSubCategories(Category $category)
    {
        if($category->subCategories){
            return $this->collection($category->subCategories,new SubCategoryTransformer);
        }
    }

}
