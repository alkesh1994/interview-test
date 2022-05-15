<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class RegistrationTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($item)
    {
        return [
            'id'         => $item->id,
            'first_name' => $item->first_name,
            'last_name'  => $item->last_name,
            'address'    => $item->address,
            'phone'      => $item->phone,
            'email'      => $item->email,
        ];
    }
}
