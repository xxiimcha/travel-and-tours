<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
        // Specify the table name if it doesn't follow Laravel's naming convention
        protected $table = 'tbl_core_tour'; // Replace with your actual table name

        // Specify which attributes can be mass assigned
        protected $fillable = [
            'destination_category',
            'destination_name',
            'destination_images',
            'destination_price',
            'destination_location',
            'destination_days',
            'destination_description',
            'destination_included',
            'destination_policy',
        ];
        
        public function dailyItineraries()
    {
        return $this->hasMany(TourItinerary::class, 'tour_id'); // Use the correct model name
    }

    
}
