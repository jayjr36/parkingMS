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
                'car_plate_number' => 'T 123 ABC',
                'card_number' => '222',
            ]);
    
            PaymentDetail::create([
                'car_plate_number' => 'T 456 XYZ',
                'card_number' => '493',
            ]);
    
            // Add more sample data as needed
        
    }
}
