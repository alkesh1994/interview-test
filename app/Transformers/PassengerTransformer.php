<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class PassengerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($item)
    {
        return [
            'id'           => $item->id,
            'paid'         => $item->paid,
            'amount'       => $item->amount,
            'flight'       => $item->flight,
            'registration' => $item->registration,
        ];
    }
}
