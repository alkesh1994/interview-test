<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Transformers\PassengerTransformer;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;
use Spatie\Fractal\Fractal;
use

class PassengerController extends ApiController
{
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), $this->validationRules(), $this->validationMessage());
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors(), 'code' => 422], 422);
        }
        $passenger = Passenger::create($request->all());
        $response  = fractal()
            ->item($passenger)
            ->transformWith(new PassengerTransformer())
            ->serializeWith(new \Spatie\Fractalistic\ArraySerializer())
            ->toArray();

        return $this->setMessage("Flight booked successfully.")
            ->respondWithStatus($response);
    }

    public function validationRules()
    {

        return [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'aadhar'     => 'required',
            'address'    => 'required',
            'phone'      => 'required',
            'email'      => 'required|email',
        ];
    }

    public function validationMessage()
    {
        return [
            'first_name' => 'First name is required.',
            'last_name'  => 'Last name is required.',
            'address'    => 'Address is required.',
            'phone'      => 'Phone is required',
            'email'      => 'Email is required',
        ];
    }

}
