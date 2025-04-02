<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function getTourItineraries()
    {
        // Fetch all itineraries
        $itineraries = DB::table('tbl_core_tours_itinerary')->get();

        // Return as JSON
        return response()->json([
            'success' => true,
            'data' => $itineraries
        ]);
    }

    public function getTourItineraryByTourId($tourId)
    {
        // Fetch itineraries by tour_id
        $itinerary = DB::table('tbl_core_tours_itinerary')
            ->where('tour_id', $tourId)
            ->orderBy('day_number')
            ->get();

        // Return as JSON
        return response()->json([
            'success' => true,
            'tour_id' => $tourId,
            'data' => $itinerary
        ]);
    }
}
