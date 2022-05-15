<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class FlightTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($item)
    {
        return [
            'id'        => $item->id,
            'departure' => $item->departure_time,
            'day'       => $item->day,
            'metro'     => $item->metro,
        ];
    }
}
