<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Product;
class ProductTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['brand','subcategory','images','reviews','sizes','tags'];
    public function transform(Product $product)
    {
        return [
            'id'=>$product->id,
            'name' => $product->name,
            'description' => $product->description,
            'image' => $product->cover_image_url,
            'short_description' => $product->short_description,
            'technical_specs'=>$product->technical_specs,
            'price'=>$product->price,
            'sku'=>$product->sku,
            'views'=>$product->views,
            'approved'=>$product->approved,
            'description_section_1_image'=>$product->description_section_1_image_url,
            'description_section_1_head'=>$product->description_section_1_head,
            'description_section_1_text'=>$product->description_section_1_text,
            'description_section_2_image'=>$product->description_section_2_image_url,
            'description_section_2_head_1'=>$product->description_section_2_head_1,
            'description_section_2_text_1'=>$product->description_section_2_text_1,
            'description_section_2_head_2'=>$product->description_section_2_head_2,
            'description_section_2_text_2'=>$product->description_section_2_text_2,
            'description_section_2_head_3'=>$product->description_section_2_head_3,
            'description_section_2_text_3'=>$product->description_section_2_text_3,
            'description_section_2_head_4'=>$product->description_section_2_head_4,
            'description_section_2_text_4'=>$product->description_section_2_text_4,
            'description_section_3_image'=>$product->description_section_3_image_url,
            'description_section_3_head'=>$product->description_section_3_head,
            'description_section_3_text'=>$product->description_section_3_text,
        ];
    }

    public function includeBrand(Product $product)
    {
        if($product->brand){
            return $this->item($product->brand,new BrandTransformer);
        }
    }
    public function includeSubCategory(Product $product)
    {
        if($product->subcategory){
            return $this->item($product->subcategory,new SubCategoryTransformer);
        }
    }
    public function includeImages(Product $product)
    {
        if($product->images){
            return $this->collection($product->images,new ProductImageTransformer);
        }
    }

    public function includeReviews(Product $product)
    {
        if($product->reviews){
            return $this->collection($product->reviews,new ProductReviewTransformer);
        }
    }

    public function includeSizes(Product $product)
    {
        if($product->sizes){
            return $this->collection($product->sizes,new ProductSizeTransformer);
        }
    }

    public function includeTags(Product $product)
    {
        if($product->tags){
            return $this->collection($product->tags,new ProductTagTransformer);
        }
    }

}
