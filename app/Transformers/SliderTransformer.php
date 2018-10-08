<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Slider;
class SliderTransformer extends TransformerAbstract
{
    public function transform(Slider $slider)
    {
        return [
            'id'=>$slider->id,
            'image' => $slider->image_url,
            'tag' => $slider->tag,
            'head1' => $slider->head1,
            'head2' => $slider->head2,
            'desc' => $slider->desc,
            'url' => $slider->url,
            'action_text' => $slider->action_text,
        ];
    }

}
