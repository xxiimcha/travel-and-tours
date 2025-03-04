<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;
class TransportBookingController extends Controller
{
    
    public function create_booking_api(Request $request){

        try{
            $validator = Validator::make($request->all(), [
                'Type' => 'required|string|',
                'manufacturer' => 'required|string',
                'car_price' => 'required|numeric|max:1000000',
                'model' => 'required|string', 
                'capacity' => 'required|integer',
                'fuel_type' => 'required|string',
                'color' => 'required|string',
                'car_description' => 'required|string',
                'policy' => 'required|string',
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
             $data = new booking;
             $data->Car_type = $request->Type;
             $data->Manufacturer = $request->manufacturer;
             $data->Car_price = $request->car_price;
             $data->Model = $request->model;
             $data->Capacity = $request->capacity;
             $data->Fuel_type = $request->fuel_type;
             $data->Colors = $request->color;
             $data->Description = $request->car_description;
             $data->Policy = $request->policy;
   
     
              // Handle multiple images
              $images = $request->file('images');
              if ($images) {
                  $imageNames = [];

                  foreach ($images as $image) {
                      $imagename = time() . '_' . $image->getClientOriginalName();
                      $image->move('booking-images', $imagename);
                      $imageNames[] = $imagename; // Save each image name in the array
                  }

                  // Store the image names as a JSON array
                  $data->booking_images = json_encode($imageNames);
              }  
             $data->save();

                     // Return success response
                         return response()->json([
                             'status' => true,
                             'message' => 'booking added successfully',
                             'data' => $data,
                             'redirect_url' => route('manage-booking')
                         ], 201);
            }catch(\throwable $th){
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500); // Return 201 for resource created
            }
    }
 
    public function manage_booking_api(){
        $data = Booking::all();
        return response()->json($data);
        
    }
    public function show($id){

        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'transportation not found'], 404);
        }
                // Decode the destination_images JSON if it's stored as a JSON array
                $images = json_decode($booking->booking_images, true); // Assuming it's stored as JSON
    
                // If images are available, map them to include the public path
                if ($images && is_array($images)) {
                    $images = array_map(function($image) {
                        return asset('booking-images/' . $image); // Prepend public path
                    }, $images);
                } else {
                    // If no images found, set to an empty array
                    $images = [];
                }

     // Return destination details along with description and policy
            return response()->json([

                'car_type' => $booking->Car_type,
                'manufacturer' => $booking->Manufacturer,
                'car_price' => $booking->Car_price,
                'Model' => $booking->Model,
                'capacity' => $booking->Capacity,
                'fuel_type' => $booking->Fuel_type,
                'colors' => $booking->Colors, // Assuming you have a policy field
                'description' => $booking->Description, 
                'policy' => $booking->Policy, 
                'images' => $images // Return array of images
            ]);
    }
    public function edit($id) {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'transport not found.'], 404);
        }
    // Return the destination data as a JSON response
    return response()->json($booking);
    }

    public function update_booking_api(Request $request, $id) {
        try{
            $validator = Validator::make($request->all(), [
                'Type' => 'required|string|',
                'manufacturer' => 'required|string',
                'car_price' => 'required|numeric|max:1000000',
                'model' => 'required|string', 
                'capacity' => 'required|integer',
                'fuel_type' => 'required|string',
                'color' => 'required|string',
                'car_description' => 'required|string',
                'policy' => 'required|string',
                'images.*' =>  ['nullable','file','max:3000','mimes:webp,png,jpg']
 
             ]);
             // If validation fails, return errors
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'something went wrong',
                     'errors' => $validator->errors()
                 ], 422);
             }
             $data =  booking::find($id);
             $data->Car_type = $request->Type;
             $data->Manufacturer = $request->manufacturer;
             $data->Car_price = $request->car_price;
             $data->Model = $request->model;
             $data->Capacity = $request->capacity;
             $data->Fuel_type = $request->fuel_type;
             $data->Colors = $request->color;
             $data->Description = $request->car_description;
             $data->Policy = $request->policy;
             $image = $request->image;     
     
             // Check if an image was uploaded
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            // Check if the old images exist and delete them
            if ($data->booking_images) {
                foreach (json_decode($data->booking_images) as $oldImage) {
                    $oldImagePath = public_path('booking-images/' . $oldImage);
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
                $image->move('booking-images', $imagename); // Move the file
                $imageNames[] = $imagename; // Store the image name
            }

            // Store the names of uploaded images as JSON
            $data->booking_images = json_encode($imageNames);
        }  
     
             $data->save();

                     // Return success response
                         return response()->json([
                             'status' => true,
                             'message' => 'booking updated successfully',
                             'data' => $data,
                             'redirect_url' => route('manage-booking') // Add redirect URL
                         ], 201);
            }catch(\throwable $th){
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500); // Return 201 for resource created
            }
    }
        public function delete_booking_api($id){
        
                $data = Booking::find($id);
            // Check if the destination exists
        if (!$data) {
            return response()->json(['error' => 'Booking not found'], 404);
        }
        // DELETE IMAGES FROM PUBLIC FOLDER
        // Decode the JSON array of image names
          $imageNames = json_decode($data->booking_images);
    
        // Check if images exist and delete them
        if ($imageNames && is_array($imageNames)) {
            foreach ($imageNames as $imageName) {
                $imagePath = public_path('booking-images/' . $imageName);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image
                }
            }
                // Delete the tour data
                $data->delete();
            
                return response()->json(['success' => 'Booking deleted successfully'], 200);
            
        }
    }
}
