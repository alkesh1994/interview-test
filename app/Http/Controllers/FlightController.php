<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Flight;
use Metro;

class FlightController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$days   = Day::all();
        $metros = Metro::all();
        foreach ($metros as $metro) {
            switch ($metro->id) {
                case 1:
                    $this->createFlights(5, 3, "00.30", $metro->id, 4);
                    break;
                case 2:
                    $this->createFlights(5, 3, "00.30", $metro->id, 4);
                case 3:
                    $this->createFlights(3, 2, "01.00", $metro->id, 5);
                    break;
                case 4:
                    $this->createFlights(3, 2, "01.00", $metro->id, 5);
                case 5:
                    $this->createFlights(4, 4, "01.30", $metro->id, 3);
                    break;
                case 6:
                    $this->createFlights(4, 4, "01.30", $metro->id, 3);
                    break;

                default:
                    // code...
                    break;
            }
        }
    }
    public function createFlights($days, $duration, $initialTime, $metroId, $itteration)
    {

        for ($i = 1; $i <= $days; $i++) {
            $newTime = Carbon::parse($initialTime);
            for ($j = 1; $j <= $itteration; $j++) {
                $departureTime = $newTime->addHour($j * $duration);
                Flight::insert([
                    [
                        "metro_id"       => $metroId,
                        "departure_time" => $departureTime,
                        "day_id"         => $i,
                        "price"          => 3000.00,
                    ],
                ]);
            }
        }
    }
}
