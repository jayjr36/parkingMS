<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_plate_number',
        'card_number',
        'expiry_date',
        'cvc',
        'amount',
        'status',
    ];
}
