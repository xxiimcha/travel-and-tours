<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Support\Facades\Validator;
class TourItineraryController extends Controller
{
    public function create_tour(Request $request){
        try{
                   $validator = Validator::make($request->all(), [
                        'destination' => 'required',
        
                    ]);

                    // If validation fails, return errors
                    if ($validator->fails()) {
                        return response()->json([
                            'status' => false,
                            'message' => 'something went wrong',
                            'errors' => $validator->errors()
                        ], 401);
                    }
                    $data = new  Destination();
                    $data -> destination = $request->destination;
                    $data -> save();

                            // Return success response
                                return response()->json([
                                    'status' => true,
                                    'message' => 'Destination added successfully',
                                    'data' => $data,
                                ], 201);

        }catch(\throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500); // Return 201 for resource created
        }
    }

    public function create_tour_api(Request  $request){
        try{
            $validator = Validator::make($request->all(), [
                'destination_category' => 'required|string|',
                'destination_name' => 'required|string',
                'destination_price' => 'required|numeric|max:1000000',
                'destination_location' => 'required|string', 
                'destination_days' => 'required|integer',
                'destination_description' => 'required|string',
                'destination_included' => 'required|string',
                'destination_policy' => 'required|string',
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
             $data = new Tour;
             $data->destination_category = $request->destination_category;
             $data->destination_name = $request->destination_name;
             $data->destination_price = $request->destination_price;
             $data->destination_location = $request->destination_location;
             $data->destination_days = $request->destination_days;
             $data->destination_description = $request->destination_description;
             $data->destination_included = $request->destination_included;
             $data->destination_policy = $request->destination_policy;
     
             
                   // Handle multiple images
                      $images = $request->file('images');
                    if ($images) {
                        $imageNames = [];

                        foreach ($images as $image) {
                            $imagename = time() . '_' . $image->getClientOriginalName();
                            $image->move('destination-images', $imagename);
                            $imageNames[] = $imagename; // Save each image name in the array
                        }

                        // Store the image names as a JSON array
                        $data->destination_images = json_encode($imageNames);
                    }

             $data->save();

                     // Return success response
                         return response()->json([
                             'status' => true,
                             'message' => 'Destination added successfully',
                             'data' => $data,
                             'redirect_url' => route('manage-tour')
                         ], 201);
            }catch(\throwable $th){
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500); // Return 201 for resource created
            }

    }
    public function show($id) {
        // Find the destination by ID
        $destination = Tour::find($id);
    
        // If the destination is not found, return a 404 response
        if (!$destination) {
            return response()->json(['message' => 'Destination not found'], 404);
        }
    
        // Decode the destination_images JSON if it's stored as a JSON array
        $images = json_decode($destination->destination_images, true); // Assuming it's stored as JSON
    
        // If images are available, map them to include the public path
        if ($images && is_array($images)) {
            $images = array_map(function($image) {
                return asset('destination-images/' . $image); // Prepend public path
            }, $images);
        } else {
            // If no images found, set to an empty array
            $images = [];
        }
    
        // Return destination details along with all images
        return response()->json([
            'name' => $destination->destination_name,
            'price' => $destination->destination_price,
            'category' => $destination->destination_category,
            'duration' => $destination->destination_days,
            'location' => $destination->destination_location,
            'description' => $destination->destination_description,
            'policy' => $destination->destination_policy,
            'included' => $destination->destination_included,
            'images' => $images // Return array of images
        ]);
    }
    
    
    

    public function edit($id){
        // Fetch the destination using the provided ID
        $destination = Tour::find($id);
        
        // Check if the destination exists
        if (!$destination) {
            // If the destination does not exist, return a 404 error
            return response()->json(['message' => 'Destination not found.'], 404);
        }
        
        // Return the destination data as a JSON response
        return response()->json($destination);
    }
    public function update_destination_api(Request $request, $id){
        try{
            $validator = Validator::make($request->all(), [
                'destination_category' => 'required|string|',
                'destination_name' => 'required|string',
                'destination_price' => 'required|numeric|max:1000000',
                'destination_location' => 'required|string', 
                'destination_days' => 'required|integer',
                'destination_description' => 'required|string',
                'destination_included' => 'required|string',
                'destination_policy' => 'required|string',
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
             $data =  Tour::find($id);
             $data->destination_category = $request->destination_category;
             $data->destination_name = $request->destination_name;
             $data->destination_price = $request->destination_price;
             $data->destination_location = $request->destination_location;
             $data->destination_days = $request->destination_days;
             $data->destination_description = $request->destination_description;
             $data->destination_included = $request->destination_included;
             $data->destination_policy = $request->destination_policy;
             $image = $request->image;             
        // Check if an image was uploaded
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            // Check if the old images exist and delete them
            if ($data->destination_images) {
                foreach (json_decode($data->destination_images) as $oldImage) {
                    $oldImagePath = public_path('destination-images/' . $oldImage);
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
                $image->move('destination-images', $imagename); // Move the file
                $imageNames[] = $imagename; // Store the image name
            }

            // Store the names of uploaded images as JSON
            $data->destination_images = json_encode($imageNames);
        }  
             $data->save();
                     // Return success response
                         return response()->json([
                             'status' => true,
                             'message' => 'Destination update successfully',
                             'data' => $data,
                             'redirect_url' => route('manage-tour') // Add redirect URL
                         ], 201);
            }catch(\throwable $th){
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ], 500); // Return 201 for resource created
            }
    }
    public function delete_destination_api($id)
    {
        // Find the destination by ID
        $data = Tour::find($id);
    
        // Check if the destination exists
        if (!$data) {
            return response()->json(['error' => 'Destination not found'], 404);
        }
    
        // DELETE IMAGES FROM PUBLIC FOLDER
        // Decode the JSON array of image names
        $imageNames = json_decode($data->destination_images);
    
        // Check if images exist and delete them
        if ($imageNames && is_array($imageNames)) {
            foreach ($imageNames as $imageName) {
                $imagePath = public_path('destination-images/' . $imageName);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image
                }
            }
        }
    
        // Delete the tour data
        $data->delete();
    
        return response()->json(['success' => 'Destination deleted successfully'], 200);
    }
    

}
