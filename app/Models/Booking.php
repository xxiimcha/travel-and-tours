<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'tbl_core_booking';
    
    // Add fillable fields if necessary
    protected $fillable = [
        'Car_type',
        'Manufacturer',
        'Car_price',
        'Model',
        'Capacity',
        'Fuel_type',
        'Colors',
        'Description',
        'Policy',
     ];
}

