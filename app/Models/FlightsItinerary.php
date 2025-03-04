<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightsItinerary extends Model
{
    use HasFactory;
    protected $table = 'tbl_core_flights_itinerary';
    
    // Add fillable fields if necessary
    protected $fillable = [
        
        'destination_name',
        'day_number',
        'description',
        'itenirary_images',
        'location',
   
     ];
     public function flights()
     {
         return $this->belongsTo(Flights::class, 'flights_id'); // Use the correct model name
     }
}
