<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Transformers\RegistrationTransformer;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;
use Spatie\Fractal\Fractal;

class RegistrationController extends ApiController
{
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), $this->validationRules(), $this->validationMessage());
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors(), 'code' => 422], 422);
        }
        $registration = Registration::create($request->all());
        $response     = fractal()
            ->item($registration)
            ->transformWith(new RegistrationTransformer())
            ->serializeWith(new \Spatie\Fractalistic\ArraySerializer())
            ->toArray();

        return $this->setMessage("Registered successfully.")
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
