<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetroSeeder extends Seeder
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

        DB::table('metros')->truncate();
        DB::table('metros')->insert(
            [
                ['name'      => "Mumbai-Delhi",
                    'slug'       => "mumbai-delhi",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Delhi-Mumbai",
                    'slug'       => "delhi-mumbai",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Mumbai-Kolkata",
                    'slug'       => "mumbai-kolkata",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Kolkata-Mumbai",
                    'slug'       => "kolkata-mumbai",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Mumbai-Chennai",
                    'slug'       => "mumbai-chennai",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
                ['name'      => "Chennai-Mumbai",
                    'slug'       => "chennai-mumbai",
                    'created_at' => $date,
                    'updated_at' => $date,
                ],
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
