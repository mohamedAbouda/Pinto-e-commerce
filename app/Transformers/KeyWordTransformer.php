<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\KeyWord;
class KeyWordTransformer extends TransformerAbstract
{
    public function transform(KeyWord $keyWord)
    {
        return [
            'id'=>$keyWord->id,
            'text' => $keyWord->text,
        ];
    }

}
