<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Address;
class AddressTransformer extends TransformerAbstract
{
    public function transform(Address $address)
    {
        return [
            'id'=>$address->id,
            'address' => $address->address,
            'phone' => $address->phone,
            'country' => $address->country,
            'city' => $address->city,
            'lat' => $address->lat,
            'lng' => $address->lng,
        ];
    }

}
