<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flights;
use App\Models\FlightsItinerary;

class FlightsItineraryController extends Controller
{
    public function create_itinerary(){

            $data = Flights::all();
        return view('admin.components.create-flights-itinerary',compact('data'));
    }

    public function create_flights_itinerary(Request $request){
        $request->validate([
            'destination_category' => 'required|string',
            'destination_name' => 'required|string',
            'daily_itinerary' => 'required|string',
            'image' =>  ['required','nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'],
            'destination_description' => 'required|string',
            'destination_location' => 'required|string',
        ]);
        
        // Split the value by the hyphen
        $destinationData = explode('-', $request->destination_name);
        $destinationId = $destinationData[0]; // This is the tour ID
        $destinationName = $destinationData[1]; // This is the destination name    
        // Save the data to the database
        $data = new FlightsItinerary;
        $data->flights_id = $destinationId; // Use the ID from the select option
        $data->destination_name = $destinationName;
        $data->destination_category = $request->destination_category;
        $data->day_number = $request->daily_itinerary; // Correct field
        $data->description = $request->destination_description; // Correct field
        $data->location = $request->destination_location; // Correct field

        $image = $request->image;
        
         // Check if an image was uploaded
         if($image){
             $imagename = time(). '.' .$image->getClientOriginalExtension();
             $request->image->move('flights-itenirary-images',$imagename);
             $data->itenirary_images =$imagename; 
         }

        $data->save();
     
        return redirect()->back()->with('success', ' itinerary created successfully!');
    }
    


}
