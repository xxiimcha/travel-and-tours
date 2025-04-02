<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransportBookingController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FlightsBookingController;
use App\Http\Controllers\TourItineraryController;
use App\Http\Controllers\FlightsItineraryController;
use App\Http\Controllers\APIController;

//API URLs

Route::get('/tour-itineraries', [APIController::class, 'getTourItineraries']);
Route::get('/tour-itinerary/{tourId}', [APIController::class, 'getTourItineraryByTourId']);
//======================== ADMIN DASHBOARD UPDATED  ======================================


Route::get('/', [CustomerController::class, 'index'])->name('home');

// Routes for authenticated users only
Route::middleware(['auth'])->group(function () {
  Route::get('/user-dashboard', [HomepageController::class, 'user_dashboard'])->name('user-dahsboard');
  Route::get('/user-profile', [HomepageController::class, 'user_profile'])->name('user-profile');
  Route::post('/update-profile', [HomepageController::class, 'update_profile'])->name('update-profile');

  Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');
  Route::get('/home', [CustomerController::class, 'index'])->name('home');
});
// Routes for guest users
Route::middleware(['guest.redirect'])->group(function () {
    // Show registration form
    Route::get('/register', [AuthenticationController::class, 'showRegistrationForm'])->name('register');

    // Register account
    Route::post('/register', [AuthenticationController::class, 'register'])->name('register-account');

    // Show login form
    Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');

    // Login account
    Route::post('/login-account', [AuthenticationController::class, 'login_user'])->name('login-account');

    Route::get('/admin/login', [AuthenticationController::class, 'showAdminLoginForm'])->name('admin.login');

    // Admin login submission
    Route::post('/admin/login-account', [AuthenticationController::class, 'login_admin'])->name('admin.login-account');

});




    
    // Route::get('/homepage', [CustomerController::class, 'index'])->name('homepage');
    // Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');
    Route::get('/home', [HomepageController::class, 'index'])->name('home');
    Route::get('/tour-package', [HomepageController::class, 'tour_package'])->name('tour-package');
    Route::get('/rentals', [HomepageController::class, 'rentals'])->name('rentals');
    Route::get('/hotel-reservation', [HomepageController::class, 'hotel_resevation'])->name('hotel-reservation');
    // Route::get('/flights', [HomepageController::class, 'flights'])->name('flights');

    Route::get('/view-details/{id}', [HomepageController::class, 'view_package'])->name('view-details');
    Route::get('/view-car-details/{id}', [HomepageController::class, 'view_car_details'])->name('view-car-details');
    Route::get('/view-hotel-details/{id}', [HomepageController::class, 'view_hotel_details'])->name('view-hotel-details');
    Route::get('/view-flights-details/{id}', [HomepageController::class, 'view_flights_details'])->name('view-flights-details');
    
//================================================================================================
// ======================= ADMIN DASHBOARD ======================================
// ======================= TOUR CREATION  ======================================
Route::get('/admin-dashboard', [AdminController::class, 'admin_dashboard'])->name('admin-dashboard');
Route::get('/admin-profile', [AdminController::class, 'admin_profile'])->name('admin-profile');
Route::get('/create-tours', [AdminController::class, 'create_tour'])->name('create-tours');
Route::get('/view-destination', [AdminController::class, 'view_destination'])->name('view-destination');
Route::get('/manage-tour', [AdminController::class, 'manage_tours'])->name('manage-tour');
Route::get('/destination/{id}', [AdminController::class, 'show']);  // View destination details
Route::get('/edit-destination/{id}', [AdminController::class, 'edit']);  // View destination details
// ======================= TRANSPORT BOOKING  ======================================
Route::get('/create-booking', [TransportBookingController::class, 'create_booking'])->name('create_booking');
Route::get('/manage-booking', [TransportBookingController::class, 'manage_booking'])->name('manage-booking');
Route::get('/view-booking/{id}', [TransportBookingController::class, 'show']);  // View destination details
Route::get('/edit-booking/{id}', [TransportBookingController::class, 'edit']); 
// =================================================================================
// ======================= HOTEL RESERVATION  ======================================
Route::get('/create-hotel', [AdminController::class, 'create_hotel'])->name('create-hotel');
Route::get('/manage-hotel', [AdminController::class, 'manage_hotel'])->name('manage-hotel');
Route::get('/view-hotel/{id}', [HotelBookingController::class, 'show']);  //
Route::get('/edit-hotel/{id}', [HotelBookingController::class, 'edit']); 
// =================================================================================
// ======================= FLIGHTS RESERVATION  ======================================
// Route::get('/create-flights', [AdminController::class, 'create_flights'])->name('create-flights');
// Route::get('/manage-flights', [AdminController::class, 'manage_flights'])->name('manage-flights');
// Route::get('/view-flights/{id}', [FlightsBookingController::class, 'show']); 
// Route::get('/edit-flights/{id}', [FlightsBookingController::class, 'edit']); 
// =================================================================================

// ======================= CREATE TOUR ITINERARY  ======================================
Route::get('/create-itinerary', [AdminController::class, 'create_itinerary'])->name('create-itinerary');
Route::post('/create_tour_itinerary', [TourItineraryController::class, 'create_tour_itinerary'])->name('create_tour_itinerary');
// ======================= CREATE FLIGHTS ITINERARY  ======================================
Route::get('/create-flights-itinerary', [FlightsItineraryController::class, 'create_itinerary'])->name('create-flights-itinerary');
Route::post('/create_flights_itinerary', [FlightsItineraryController::class, 'create_flights_itinerary'])->name('create_flights_itinerary');


// ======================= MANAGE ACCOUNT USER  ======================================
Route::get('/manage-user-account', [AdminController::class, 'manage_user_account'])->name('manage-user-account');



