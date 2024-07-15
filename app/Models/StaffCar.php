<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_name', 'car_plate_number', 'card_number',
    ];
}
