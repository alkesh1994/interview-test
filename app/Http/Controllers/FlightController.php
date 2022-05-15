<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Flight;
use App\Models\Metro;
use App\Transformers\FlightTransformer;
use Carbon\Carbon;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;

class FlightController extends ApiController
{
    public function index()
    {
        $flights = Flight::paginate(10);
        if ($flights->isEmpty()) {
            return $this->respondNotFound("Records not found.");
        }

        $response = fractal()
            ->collection($flights)
            ->transformWith(new FlightTransformer())
            ->serializeWith(new \Spatie\Fractalistic\ArraySerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($flights))
            ->toArray();
        $response = $this->convertPaginationResponse($response);

        return $this->setMessage("Flights.")
            ->respondWithStatus($response);
    }

    public function generate()
    {
        //$days   = Day::all();
        $metros = Metro::all();
        foreach ($metros as $metro) {
            switch ($metro->id) {
                case 1:
                    for ($i = 1; $i <= 5; $i++) {
                        $this->createFlights($i, 3, "00.30", $metro->id, 4);
                    }
                    break;
                case 2:
                    for ($i = 1; $i <= 5; $i++) {
                        $this->createFlights($i, 3, "00.30", $metro->id, 4);
                    }
                case 3:
                    for ($i = 1; $i <= 3; $i++) {
                        $this->createFlights($i, 2, "01.00", $metro->id, 5);
                    }
                    break;
                case 4:
                    for ($i = 1; $i <= 3; $i++) {
                        $this->createFlights($i, 2, "01.00", $metro->id, 5);
                    }
                case 5:
                    for ($i = 1; $i <= 4; $i++) {
                        $this->createFlights($i, 4, "01.30", $metro->id, 3);
                    }
                    break;
                case 6:
                    for ($i = 1; $i <= 4; $i++) {
                        $this->createFlights($i, 4, "01.30", $metro->id, 3);
                    }
                    break;

                default:
                    // code...
                    break;
            }
        }
        return response()->json(["message" => 'Flights inserted successfully'], 200);
    }
    public function createFlights($day, $duration, $initialTime, $metroId, $itteration)
    {

        for ($j = 1; $j <= $itteration; $j++) {
            $newTime = Carbon::parse($initialTime);
            if ($j == 1) {
                $departureTime = $newTime;
            } else {
                $departureTime = $newTime->addHour($j * $duration);
            }
            Flight::insert([
                [
                    "metro_id"       => $metroId,
                    "departure_time" => $departureTime,
                    "day_id"         => $day,
                    "price"          => 3000.00,
                ],
            ]);
        }
    }
}
