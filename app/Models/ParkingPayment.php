<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'payment_fee',
        'time_spent',
        'status',
    ];
}
