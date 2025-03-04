<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Booking;
use App\Models\Flights;
use App\Models\Customer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;



class HomepageController extends Controller
{
    public function index() {
        if (Auth::check()) { // Check if the user is authenticated
            $user = Auth::user(); // Get the logged-in user
            $details = $user->details; // Assuming 'details' is a relationship in User.php
            return view('index', compact('user', 'details')); // Return view for authenticated user
        } else {
            // Redirect non-authenticated users to the login page or another page
            return view('index'); // Return view for authenticated user
        }
    }
    

    
    public function login(){
        return view('login');
    }  
    public function register(){
        return view('register');
    }
    public function user_dashboard(){
        return view('user-dashboard');
    }
    public function user_profile(){
        $user = Auth::user(); // Get the logged-in user
        $details = $user->details; // ITS details is from User.php
        return view('user-profile',compact('user','details'));
    }
    public function tour_package(){
        $data = Tour::latest()->paginate(6);

        foreach ($data as $tour) {
            // Decode the JSON to get the array of images
            $images = json_decode($tour->destination_images, true);
        
            // Assign the first image to a new property
            $tour->first_image = $images[0] ?? null; // Safely handle cases with no images
        }
        
        $destination = Destination::all();
        return view('tour-package-details', compact('data', 'destination'));
        
        
    }
    public function rentals(){
        $data = Booking::latest()->paginate(6);

        foreach ($data as $booking) {
            // Decode the JSON to get the array of images
            $images = json_decode($booking->booking_images, true);
        
            // Assign the first image to a new property
            $booking->first_image = $images[0] ?? null; // Safely handle cases with no images
        }
        
        return view('transport-booking',compact('data'));
    }
    public function hotel_resevation(){
        $data = Hotel::latest()->paginate(6);

        foreach ($data as $hotel) {
            // Decode the JSON to get the array of images
            $images = json_decode($hotel->hotel_image, true);
        
            // Assign the first image to a new property
            $hotel->first_image = $images[0] ?? null; // Safely handle cases with no images
        }
        return view('hotel-reservation',compact('data'));
    }
    public function flights(){
        $data = Flights::latest()->paginate(6);

        foreach ($data as $flights) {
            // Decode the JSON to get the array of images
            $images = json_decode($flights->flights_images, true);
        
            // Assign the first image to a new property
            $flights->first_image = $images[0] ?? null; // Safely handle cases with no images
        }
        return view('flights',compact('data'));
    }



    public function view_package($id){
       // Fetch the tour data by ID
    $data = Tour::find($id);
         // Handle the case where no record is found
         if (!$data) {
            abort(404, 'Booking not found.');
        }
    // Ensure 'destination_images' exists and is a valid JSON field
    $images = [];
    if (!empty($data->destination_images)) {
        $images = json_decode($data->destination_images, true);

        // Check if decoding is successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            $images = []; // Reset to an empty array for invalid JSON
        }
    }
    //  ITINERARY DETAILS
    $itinerary = Tour::with(['dailyItineraries' => function ($query) {
        $query->orderBy('day_number', 'asc'); // Sort by day_number in ascending order
       }])->findOrFail($id);

    // Assign the first image to a new property for convenience
    $data->first_image = $images[0] ?? null; // Safely handle cases with no images

    return view('view-details', compact('data', 'images','itinerary'));

    }
    public function view_car_details($id)
    {
        // Fetch the booking data by ID
        $data = Booking::find($id);
    
        // Handle the case where no record is found
        if (!$data) {
            abort(404, 'Booking not found.');
        }
    
        // Decode the images field if it exists and is valid JSON
        $images = [];
        if (!empty($data->booking_images)) {
            $images = json_decode($data->booking_images, true);
    
            // Check if decoding is successful
            if (json_last_error() !== JSON_ERROR_NONE) {
                $images = []; // Reset to an empty array for invalid JSON
            }
        }
    
        // Assign the first image to a new property for convenience
        $data->first_image = $images[0] ?? null; // Safely handle cases with no images
    
        return view('view-car-details', compact('data', 'images'));
    }
    public function view_hotel_details($id){
                // Fetch the booking data by ID
                $data = Hotel::find($id);
    
                // Handle the case where no record is found
                if (!$data) {
                    abort(404, 'Hotel not found.');
                }
            
                // Decode the images field if it exists and is valid JSON
                $images = [];
                if (!empty($data->hotel_image)) {
                    $images = json_decode($data->hotel_image, true);
            
                    // Check if decoding is successful
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $images = []; // Reset to an empty array for invalid JSON
                    }
                }
            
                // Assign the first image to a new property for convenience
                $data->first_image = $images[0] ?? null; // Safely handle cases with no images
            
        return view('view_hotel_details',compact('data','images'));
    }
    public function view_flights_details($id){
        // Fetch the booking data by ID
        $data = Flights::find($id);

        // Handle the case where no record is found
        if (!$data) {
            abort(404, 'Hotel not found.');
        }
    
        // Decode the images field if it exists and is valid JSON
        $images = [];
        if (!empty($data->flights_images)) {
            $images = json_decode($data->flights_images, true);
    
            // Check if decoding is successful
            if (json_last_error() !== JSON_ERROR_NONE) {
                $images = []; // Reset to an empty array for invalid JSON
            }
        }
          //  ITINERARY DETAILS
    $itinerary = Flights::with(['dailyItineraries' => function ($query) {
        $query->orderBy('day_number', 'asc'); // Sort by day_number in ascending order
       }])->findOrFail($id);

        // Assign the first image to a new property for convenience
        $data->first_image = $images[0] ?? null; // Safely handle cases with no images
    
return view('view-flights-details',compact('data','images','itinerary'));
}

public function update_profile(Request $request){
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'gender' => 'nullable|string',
        'email' => 'required|email|max:255',
        'phone_number' => 'nullable|string|max:15',
        'user_images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    //==============================================================================
    // $user = Auth::user();
    // // Update the 'tbl_core_custoner' table
    // $userDetails = Customer::updateOrCreate(
    //     ['user_id' => $user->uuid],
    //     $request->only('firstname', 'lastname', 'address', 'gender', 'email', 'phone_number')
    // );
        //=========================================
    // original code 
    // Attempt to find the record based on the 'user_id'
       $user = Auth::user();
$userDetails = Customer::where('user_id', $user->uuid)->first();

if ($userDetails) {
    // If the record exists, update it with the provided data
    $userDetails->update($request->only('firstname', 'lastname', 'address', 'gender', 'email', 'phone_number'));
} else {
    // If the record doesn't exist, create a new one
    $userDetails = Customer::create(array_merge(
        ['user_id' => $user->uuid], // Add the user_id
        $request->only('firstname', 'lastname', 'address', 'gender', 'email', 'phone_number')
    ));

    // ORIGINAL CODE
    // $data = [
    //     'user_id' => $user->uuid, // Add the user_id
    // ];
    // // Manually add other fields from the request
    // $data['firstname'] = $request->input('firstname');
    // $data['lastname'] = $request->input('lastname');
    // $data['address'] = $request->input('address');
    // $data['gender'] = $request->input('gender');
    // $data['email'] = $request->input('email');
    // $data['phone_number'] = $request->input('phone_number');
    // // Create a new record with the constructed data
    // $userDetails = Customer::create($data);
}
//==============================================================================
     // Handle image upload
     if ($request->hasFile('user_images')) {
        // Get the path of the existing image
        $existingImagePath = public_path('profile-pictures/' . $userDetails->user_images);

        // Check if the existing image exists and delete it if necessary
        if (file_exists($existingImagePath) && $userDetails->user_images !== null) {
            unlink($existingImagePath); // Delete the existing image
        }

        // Upload the new image
        $image = $request->file('user_images');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('profile-pictures'), $imagename);

        // Update user details with the new image name
        $userDetails->user_images = $imagename;
    }

    // Save the user details
    $userDetails->save();
    $user->save();

    // Redirect with a success message
    return redirect()->back()->with('success', 'Profile updated successfully!');
}
    
}



