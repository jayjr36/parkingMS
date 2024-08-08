<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentDetail;

class PaymentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            PaymentDetail::create([
                'car_plate_number' => 'T 564 EAC',
                'card_number' => '222',
                'image_path' => '',
                'parking_slot' => 2
            ]);
    
            PaymentDetail::create([
                'car_plate_number' => 'T 215 DZY',
                'card_number' => '493',
                    'image_path' => '',
                'parking_slot' => 4
            ]);
    
            // Add more sample data as needed
        
    }
}
