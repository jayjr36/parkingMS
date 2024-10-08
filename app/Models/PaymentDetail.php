<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_plate_number',
        'card_number',
        'image_path',
        'parking_slot'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}