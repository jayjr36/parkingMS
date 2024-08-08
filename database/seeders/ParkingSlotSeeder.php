<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParkingSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $slots = [
            ['slot_number' => 1, 'status' => 'available'],
            ['slot_number' => 2, 'status' => 'available'],
            ['slot_number' => 3, 'status' => 'available'],
            ['slot_number' => 4, 'status' => 'available'],
        ];

        DB::table('parking_slots')->insert($slots);
    }
}
