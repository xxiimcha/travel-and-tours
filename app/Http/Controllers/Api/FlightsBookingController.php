<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flights;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // Import Carbon TO USE DATE
class FlightsBookingController extends Controller
{
    
    public function create_flights_api(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'flights_title' => 'required|string|',            
                'flights_price' => 'required|numeric|max:1000000',
                'flights_from' => 'required|string', 
                'flights_to' => 'required|string',          
                'flights_description' => 'required|string',
                'flights_policy' => 'required|string',
                'flights_included' => 'required|string',
                'images.*' => 'required|file|max:3000|mimes:webp,png,jpg',
             ]);
             // If validation fails, return errors
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'something went wrong',
                     'errors' => $validator->errors()
                 ], 422);
             }
             $data = new Flights;
             $data->flights_title = $request->flights_title;
             $data->flights_price = $request->flights_price;
             $data->flights_from = $request->flights_from;
             $data->flights_to = $request->flights_to;
             $data->flights_description = $request->flights_description;
             $data->flights_included = $request->flights_included;
             $data->flights_policy = $request->flights_policy;
    
   
     
              // Handle single image
            $images = $request->file('images'); // Assuming your input field name is 'image'
            if ($images) {
                $imageNames = [];

                foreach ($images as $image) {
                    $imagename = time() . '_' . $image->getClientOriginalName();
                    $image->move('flights-images', $imagename);
                    $imageNames[] = $imagename; // Save each image name in the array
                }

                // Store the image names as a JSON array
                $data->flights_images = json_encode($imageNames);
            }  

             $data->save();

                     // Return success response
                         return response()->json([
                             'status' => true,
                             'message' => 'Flights added successfully',
                             'data' => $data,
                             'redirect_url' => route('manage-flights')
                         ], 201);

            }catch(\throwable $th){
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500); // Return 201 for resource created
            }
    }

    public function show($id)
    {
        $booking = Flights::find($id);
    
        // Check if the booking record exists
        if (!$booking) {
            return response()->json(['message' => 'Flights not found'], 404);
        }
      
         $images = json_decode($booking->flights_images, true); // Assuming it's stored as JSON
    
         // If images are available, map them to include the public path
         if ($images && is_array($images)) {
             $images = array_map(function($image) {
                 return asset('flights-images/' . $image); // Prepend public path
             }, $images);
         } else {
             // If no images found, set to an empty array
             $images = [];
         }
              // Format the 'flights_from' and 'flights_to' fields
    $flightsFrom = Carbon::parse($booking->flights_from)->format('F j, Y'); // e.g., November 21, 2024
    $flightsTo = Carbon::parse($booking->flights_to)->format('F j, Y'); // e.g., November 22, 2024
    
    
        // Return the booking details along with the image
        return response()->json([
            'flights_title' => $booking->flights_title,
            'flights_price' => $booking->flights_price,
            'flights_from' => $flightsFrom,
            'flights_to' => $flightsTo,
            'flights_description' => $booking->flights_description,
            'flights_policy' => $booking->flights_policy,
            'flights_included' => $booking->flights_included,
            
            'images' => $images, // Return single image URL
        ]);
    }
 
    public function update_flights_api(Request $request,$id){
        try{
            $validator = Validator::make($request->all(), [
                'flights_title' => 'required|string|',            
                'flights_price' => 'required|numeric|max:1000000',
                'flights_from' => 'required|string', 
                'flights_to' => 'required|string',          
                'flights_description' => 'required|string',
                'flights_policy' => 'required|string',
                'flights_included' => 'required|string',
                'images.*' => 'required|file|max:3000|mimes:webp,png,jpg',
             ]);
             // If validation fails, return errors
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'something went wrong',
                     'errors' => $validator->errors()
                 ], 422);
             }
             $data =  Flights::find($id);
             $data->flights_title = $request->flights_title;
             $data->flights_price = $request->flights_price;
             $data->flights_from = $request->flights_from;
             $data->flights_to = $request->flights_to;
             $data->flights_description = $request->flights_description;
             $data->flights_included = $request->flights_included;
             $data->flights_policy = $request->flights_policy;
    
   
     
            // Handle multiple image uploads
        if ($request->hasFile('images')) {
            // Check if the old images exist and delete them
            if ($data->flights_images) {
                foreach (json_decode($data->flights_images) as $oldImage) {
                    $oldImagePath = public_path('flights-images/' . $oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Delete the old image
                    }
                }
            }
            
            // Prepare an array to hold new image names
            $imageNames = [];

            // Loop through each uploaded image
            foreach ($request->file('images') as $image) {
                $imagename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('flights-images', $imagename); // Move the file
                $imageNames[] = $imagename; // Store the image name
            }

            // Store the names of uploaded images as JSON
            $data->flights_images = json_encode($imageNames);
        }  

             $data->save();

                     // Return success response
                         return response()->json([
                             'status' => true,
                             'message' => 'Flights update successfully',
                             'data' => $data,
                             'redirect_url' => route('manage-flights')
                         ], 201);
            }catch(\throwable $th){
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500); // Return 201 for resource created
            }
    }



    public function delete_flights_api($id)
    {
        $data = Flights::find($id);
    
        // Check if the flight record exists
        if (!$data) {
            return response()->json(['error' => 'Flight not found'], 404);
        }
    
       // DELETE IMAGE FROM PUBLIC FOLDER
       $image_path = public_path('flights-images/' . $data->flights_images);
        
       if (file_exists($image_path)) {
           unlink($image_path); // Delete the image
       }
   
       // // DELETE IMAGES FROM PUBLIC FOLDER
       // Decode the JSON array of image names
       $imageNames = json_decode($data->flights_images);
   
       // Check if images exist and delete them
       if ($imageNames && is_array($imageNames)) {
           foreach ($imageNames as $imageName) {
               $imagePath = public_path('flights-images/' . $imageName);
               if (file_exists($imagePath)) {
                   unlink($imagePath); // Delete the image
               }
           }
        // Delete the flight data
        $data->delete();
    
        return response()->json(['success' => 'Flights deleted successfully'], 200);
    }
}
    public function edit($id) {
        $booking = Flights::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Flights not found.'], 404);
        }
    // Return the destination data as a JSON response
    return response()->json($booking);
    }
}

