<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourItinerary extends Model
{
    use HasFactory;
    protected $table = 'tbl_core_tours_itinerary';
    
    // Add fillable fields if necessary
    protected $fillable = [
        
        'destination_name',
        'day_number',
        'description',
        'itenirary_images',
        'location',
   
     ];

     public function tour()
     {
         return $this->belongsTo(Tour::class, 'tour_id'); // Use the correct model name
     }
}
