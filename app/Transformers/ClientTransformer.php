<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Client;
class ClientTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['address'];
    public function transform(Client $client)
    {
        return [
            'id'=>$client->id,
            'name' => $client->name,
            'email' => $client->email,
            'is_active' => $client->is_active,
            'phone' => $client->phone,
            'is_phone_verified' => $client->is_phone_verified,
            'gender' => $client->gender,
            'profile_pic' => $client->profile_pic_url,
            'is_phone_verfied' => $client->is_phone_verfied,
            'api_token'=>$client->api_token,

        ];
    }

     public function includeAddress(Client $client)
    {
        if($client->address){
            return $this->item($client->address,new AddressTransformer);
        }
    }

}
