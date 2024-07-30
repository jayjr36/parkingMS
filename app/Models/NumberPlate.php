<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberPlate extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number',
        'card_no',
        'image_path',
    ];
}
