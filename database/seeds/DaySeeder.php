<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('days')->truncate();
        DB::table('days')->insert(
            [
                ['name'      => "Sunday",
                    'slug'       => "sunday",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Monday",
                    'slug'       => "monday",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Tuesday",
                    'slug'       => "tuesday",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Wednesday",
                    'slug'       => "wednesday",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Thursday",
                    'slug'       => "thursday",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Friday",
                    'slug'       => "friday",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Saturday",
                    'slug'       => "saturday",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
