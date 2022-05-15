<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Passenger;
use App\Models\Registration;
use App\Transformers\PassengerTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;
use Spatie\Fractal\Fractal;
use Validator;

class PassengerController extends ApiController
{
    public function create(Request $request)
    {
        //validation
        $validate = Validator::make($request->all(), $this->validationRules(), $this->validationMessage());
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors(), 'code' => 422], 422);
        }
        //check for plane capacity for that day
        $passengerCount = Passenger::where('booking_time', '=', $request->booking_time)
            ->where('flight_id', '=', $request->flight_id)
            ->get()
            ->count();
        if ($passengerCount > 180) {
            return response()->json(["errors" => 'Bookings are full'], 422);
        }
        //create passenger
        if ($request->phone) {
            $registration = Registration::where('phone', '=', $request->phone)->first();
            $passenger    = Passenger::create([
                "flight_id"       => $request->flight_id,
                "registration_id" => $registration->id,
                "booking_time"    => $request->booking_time,
                "paid"            => $request->paid ?? 300.00,
                "amount"          => $this->getFlightPrice($request->booking_time),
            ]);
        }
        $response = fractal()
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
            'flight_id'    => 'required',
            'phone'        => 'required',
            'booking_time' => 'required',
            //'address'      => 'required',
            'phone'        => 'required',
        ];
    }

    public function validationMessage()
    {
        return [
            'flight_id'    => 'Flight is required',
            'phone'        => 'Phone is required',
            'booking_time' => 'Booking date and time is required',
            'phone'        => 'required',
        ];
    }
    //time wise flight price
    public function getFlightPrice($bookingTime)
    {
        $cost = 3000.00;
        $now  = Carbon::now();
        //dd($now);
        $booking = Carbon::parse($bookingTime);
        if ($bookingTime > $now) {
            $hour = $booking->diffInHours($now);
            switch ($hour) {
                case 1:
                    $amount = $cost + ($cost * 0.1);
                    return $amount;
                    break;
                case 2:
                    $amount = $cost + ($cost * 0.09);
                    return $amount;
                    break;
                case 3:
                    $amount = $cost + ($cost * 0.08);
                    return $amount;
                    break;
                case 4:
                    $amount = $cost + ($cost * 0.07);
                    return $amount;
                    break;
                case 5:
                    $amount = $cost + ($cost * 0.06);
                    return $amount;
                    break;

                default:
                    $amount = $cost;
                    break;
            }
        }
    }

}
