<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TokenModel;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Flights;
use App\Models\Customer;
use App\Http\Controllers\Api\registerController;
use App\Http\Controllers\Api\TourItineraryController;
use App\Http\Controllers\Api\TransportBookingController;
use App\Http\Controllers\Api\HotelBookingController;
use App\Http\Controllers\Api\FlightsBookingController;


//Register
Route::post('/register',[registerController::class,'register'])->name('register-api');
//Register
Route::post('/login',[registerController::class,'login'])->name('login-api');
// ADD DESTINATION
Route::post('/create-destination-api', [TourItineraryController::class, 'create_tour'])->name('create-destination-api');
// ADD  DESTINATION MORE 
Route::post('/create-destination-Api', [TourItineraryController::class, 'create_tour_api'])->name('create-destination-Api');
//  VIEW ALL DESTINATION
Route::get('/view-destination-api',function(Request $request) {
    $data = Tour::all();
    return response()->json($data);
});
//  VIEW ALL CUSTOMER API 
Route::get('/customer-api',function(Request $request) {
    $data = Customer::all();
    return response()->json($data);
});
//=========================  DESTINATION =================================
// VIEW DESTINATION EACH
Route::get('/destination/{id}', [TourItineraryController::class, 'show']); // View destination details
// VIEW DESTINATION EACH
Route::get('/edit-destination/{id}', [TourItineraryController::class, 'edit']);  // View destination details
// UPDATE
Route::post('/update-destination-api/{id}', [TourItineraryController::class, 'update_destination_api'])->name('update-destination-api'); 
// DELETE
Route::post('/delete-destination-api/{id}', [TourItineraryController::class, 'delete_destination_api'])->name('delete-destination-api');  // View destination details
//  GET DESTINATION
Route::get('/get-destination-api',function(Request $request) {
    $data =  Destination::all();
    return response()->json($data);
});
//===============================================================================



//=========================  TRANSPORT BOOKING =================================
Route::post('/create-booking-api', [TransportBookingController::class, 'create_booking_api'])->name('create-booking-api'); 
Route::get('/view-booking/{id}', [TransportBookingController::class, 'show']); 
Route::get('/edit-booking/{id}', [TransportBookingController::class, 'edit']); 
Route::post('/update-booking-api/{id}', [TransportBookingController::class, 'update_booking_api'])->name('update-booking-api');  // View destination details
Route::post('/delete-booking-api/{id}', [TransportBookingController::class, 'delete_booking_api'])->name('delete-booking-api');  
//  VIEW ALL Booking
Route::get('/view-booking-api',function(Request $request) {
    $data = Booking::all();
    return response()->json($data);
});
//===============================================================================

//=========================  HOTEL RESERVATION =================================
Route::post('/create-hotel-api', [HotelBookingController::class, 'create_hotel_api'])->name('create-hotel-api'); 
Route::get('/edit-hotel/{id}', [HotelBookingController::class, 'edit']); 
Route::post('/update-hotel-api/{id}', [HotelBookingController::class, 'update_hotel_api'])->name('update-hotel-api'); 
Route::post('/delete-hotel-api/{id}', [HotelBookingController::class, 'delete_hotel_api'])->name('delete-hotel-api'); 
Route::get('/view-hotel/{id}', [HotelBookingController::class, 'show']); 
Route::get('/view-hotel-api',function(Request $request) {
    $data = Hotel::all();
    return response()->json($data);
});
//===============================================================================
//=========================  FLIGHTS  ===========================================
// Route::post('/create-flights-api', [FlightsBookingController::class, 'create_flights_api'])->name('create-flights-api'); 
// Route::get('/view-flights-api',function(Request $request) {
//     $data = Flights::all();
//     return response()->json($data);
// });
// Route::post('/delete-flights-api/{id}', [FlightsBookingController::class, 'delete_flights_api'])->name('delete-flights-api'); 
// Route::post('/update-flights-api/{id}', [FlightsBookingController::class, 'update_flights_api'])->name('update-flights-api'); 
// Route::get('/view-flights/{id}', [FlightsBookingController::class, 'show']); 
// Route::get('/edit-flights/{id}', [FlightsBookingController::class, 'edit']); 
//===============================================================================


Route::get('/getToken', function(){
    // dd(tokenModel::where('username','admin')->first());
       $user =  TokenModel::where('username','admin')->first();
       $token = $user->createToken("auth_token")->plainTextToken;
       dd($token);
});



// MIDDLEWARE  ADMIN
Route::group([
    "middleware" => ["auth:sanctum"]
], function () {
    //profile page
    Route::get('profile', [registerController::class, 'profile']);

    //logout
    Route::get('logout', [registerController::class, 'logout']);

});


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::get('/secured', function(){
//     return "secured q";
// })->middleware('auth:sanctum');