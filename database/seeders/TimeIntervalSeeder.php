<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TimeIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startTime = Carbon::createFromTime(0, 0, 10); // Start at 00:00:00
        $endTime = Carbon::createFromTime(0, 0, 22); // End at 00:00:10

        $timeIntervals = [];

        while ($startTime->lessThanOrEqualTo($endTime)) {
            $timeIntervals[] = [
                'time' => $startTime->format('H:i:s'),
                'status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Increment by 2 hours
            $startTime->addSecond();
        }

        // Insert all time intervals into the database
        DB::table('date_times')->insert($timeIntervals);
    }
}

