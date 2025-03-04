<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flights extends Model
{
    use HasFactory;
    protected $table = 'tbl_core_flights';
    
    // Add fillable fields if necessary
    protected $fillable = [
        'flights_title',
        'flights_price',
        'flights_from',
        'flights_to',
        'flights_description',
        'flights_policy',
        'flights_images',
     
     ];

     public function dailyItineraries()
     {
         return $this->hasMany(FlightsItinerary::class, 'flights_id'); // Use the correct model name
     }
}
