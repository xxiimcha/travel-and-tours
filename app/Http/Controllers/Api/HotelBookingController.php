<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\Validator;

class HotelBookingController extends Controller
{
    public function create_hotel_api(Request $request){
        
        try{
            $validator = Validator::make($request->all(), [
                'hotel_name' => 'required|string|',
                'hotel_price' => 'required|numeric|max:1000000',
                'room_type' => 'required|string', 
                'capacity' => 'required|integer',
                'hotel_description' => 'required|string',
                'hotel_policy' => 'required|string',
                'hotel_included' => 'required|string',
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
             $data = new Hotel;
             $data->hotel_name = $request->hotel_name;
             $data->hotel_price = $request->hotel_price;
             $data->room_type = $request->room_type;
             $data->capacity = $request->capacity;
             $data->hotel_description = $request->hotel_description;
             $data->hotel_policy = $request->hotel_policy; 
             $data->hotel_included = $request->hotel_included;       
              // Handle multiple images
              $images = $request->file('images');
              if ($images) {
                  $imageNames = [];

                  foreach ($images as $image) {
                      $imagename = time() . '_' . $image->getClientOriginalName();
                      $image->move('hotel-images', $imagename);
                      $imageNames[] = $imagename; // Save each image name in the array
                  }

                  // Store the image names as a JSON array
                  $data->hotel_image = json_encode($imageNames);
              }  
             $data->save();

                     // Return success response
                         return response()->json([
                             'status' => true,
                             'message' => 'Hotel added successfully',
                             'data' => $data,
                             'redirect_url' => route('manage-hotel')
                         ], 201);
            }catch(\throwable $th){
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500); // Return 201 for resource created
            }
    }

    public function show($id){

        $booking = Hotel::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }
         // Decode the destination_images JSON if it's stored as a JSON array
         $images = json_decode($booking->hotel_image, true); // Assuming it's stored as JSON
    
         // If images are available, map them to include the public path
         if ($images && is_array($images)) {
             $images = array_map(function($image) {
                 return asset('hotel-images/' . $image); // Prepend public path
             }, $images);
         } else {
             // If no images found, set to an empty array
             $images = [];
         }

     // Return destination details along with description and policy
            return response()->json([

                'hotel_name' => $booking->hotel_name,
                'hotel_price' => $booking->hotel_price,
                'room_type' => $booking->room_type,
                'capacity' => $booking->capacity,
                'hotel_description' => $booking->hotel_description,
                'hotel_policy' => $booking->hotel_policy,
                'hotel_included' => $booking->hotel_included,
                'images' => $images // Return array of images
            ]);
    }
    public function edit($id) {
        $booking = Hotel::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Hotel not found.'], 404);
        }
    // Return the destination data as a JSON response
    return response()->json($booking);
    }

    public function delete_hotel_api($id){
        
        $data = Hotel::find($id);
    
        // Check if the destination exists
        if (!$data) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }
    
        // DELETE IMAGE FROM PUBLIC FOLDER
        $image_path = public_path('hotel-images/' . $data->hotel_image);
        
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the image
        }
    
        // // DELETE IMAGES FROM PUBLIC FOLDER
        // Decode the JSON array of image names
        $imageNames = json_decode($data->hotel_image);
    
        // Check if images exist and delete them
        if ($imageNames && is_array($imageNames)) {
            foreach ($imageNames as $imageName) {
                $imagePath = public_path('hotel-images/' . $imageName);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image
                }
            }
            $data->delete();
    
            return response()->json([
                'success' => 'Hotel deleted successfully',
                'redirect_url' => route('manage-hotel') // Add redirect URL
            ], 200);
        }
     
    
}

public function update_hotel_api(Request $request,$id){
        
    try{
        $validator = Validator::make($request->all(), [
            'hotel_name' => 'required|string|',
            'hotel_price' => 'required|numeric|max:1000000',
            'room_type' => 'required|string', 
            'capacity' => 'required|integer',
            'hotel_description' => 'required|string',
            'hotel_policy' => 'required|string',
            'hotel_included' => 'required|string',
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
         $data = Hotel::find($id);
         $data->hotel_name = $request->hotel_name;
         $data->hotel_price = $request->hotel_price;
         $data->room_type = $request->room_type;
         $data->capacity = $request->capacity;
         $data->hotel_description = $request->hotel_description;
         $data->hotel_policy = $request->hotel_policy;   
         $data->hotel_included = $request->hotel_included;     
         $image = $request->image;     
     
             // Check if an image was uploaded
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            // Check if the old images exist and delete them
            if ($data->hotel_image) {
                foreach (json_decode($data->hotel_image) as $oldImage) {
                    $oldImagePath = public_path('hotel-images/' . $oldImage);
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
                $image->move('hotel-images', $imagename); // Move the file
                $imageNames[] = $imagename; // Store the image name
            }

            // Store the names of uploaded images as JSON
            $data->hotel_image = json_encode($imageNames);
        }  
     
         $data->save();

                 // Return success response
                     return response()->json([
                         'status' => true,
                         'message' => 'Hotel Updated successfully',
                         'data' => $data,
                         'redirect_url' => route('manage-hotel') // Add redirect URL
                     ], 201);
        }catch(\throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500); // Return 201 for resource created
        }
}
}
