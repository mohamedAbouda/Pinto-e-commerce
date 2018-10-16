<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Client;
class SimpleClientTransformer extends TransformerAbstract
{
    public function transform(Client $client)
    {
        return [
            'id'=>$client->id,
            'name' => $client->name,
            'email' => $client->email,
            'phone' => $client->phone,
            'gender' => $client->gender,
            'profile_pic' => $client->profile_pic_url,
        ];
    }

}
