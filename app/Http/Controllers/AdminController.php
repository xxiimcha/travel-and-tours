<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\User;
use App\Models\Booking;

class AdminController extends Controller
{

    //========================== UPDATED ADMIN DASHBOARD ============================
    public function AdminDashboard(){
        return view('layouts.hr3-admin');
    }
      //======================================================
    public function admin_dashboard(){
        return view('admin.dashboard');
    }
    public  function admin_profile(){
        return view('admin.admin-profile');
    }
    public  function create_tour(){
        return view('admin.components.create-tours');
    }
    public  function manage_tours(){
        return view('admin.components.manage-tours');
    }
        public function create_hotel(){
            return view('admin.components.create-hotel');
        }
        public function manage_hotel(){
            return view('admin.components.manage-hotel');
        }
    public  function view_destination(){
        return view('admin.components.view-destination');
    }
    public function create_flights(){
        return view('admin.components.create-flights');
    }
    public function manage_flights(){
        return view('admin.components.manage-flights');
    }

    public function manage_user_account()
    {
        // Retrieve only users with role 'user'
        $users = User::where('role', 'user')->get();

        // Retrieve only users with role 'admin'
        $admins = User::where('role', 'admin')->get();

        return view('admin.components.manage-user-account', compact('users', 'admins'));
    }

    public function create_itinerary(){
        $data = Tour::all();
        return view('admin.components.create-tour-itinerary',compact('data'));
    }


    public function show($id) {
        $destination = Tour::find($id);
        if (!$destination) {
            abort(404, 'Destination not found');
        }
        
        return view('admin.components.view-destination', compact('destination'));
    }
    public function edit($id) {
        $destination = Tour::find($id);
        if (!$destination) {
            abort(404, 'Destination not found');
        }
        return view('admin.components.view-destination-edit', compact('destination'));
    }

    // public function show_booking($id) {
    //     $booking = Booking::find($id);
    //     if (!$booking) {
    //         abort(404, 'booking not found');
    //     }

    //     return view('admin.components.view-booking-edit', compact('booking'));
    // }
    
}
