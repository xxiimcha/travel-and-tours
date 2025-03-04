<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'tbl_core_hotel';
    
    // Add fillable fields if necessary
    protected $fillable = [
        'hotel_name',
        'hotel_price',
        'room_type',
        'capacity',
        'hotel_description',
        'hotel_policy',
        'hotel_image',
     ];
}
