<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class TransportBookingController extends Controller
{
    public function create_booking(){
        return view('admin.components.create-booking');
    }

    public function manage_booking(){
        return view('admin.components.manage-booking');
    }
    public function show($id) {
        $booking = Booking::find($id);
        if (!$booking) {
            abort(404, 'Destination not found');
        }

        return view('admin.components.view-booking', compact('booking'));
    }
    public function edit($id) {
        $booking = Booking::find($id);
        if (!$booking) {
            abort(404, 'Transportation not found');
        }
        return view('admin.components.view-booking-edit', compact('booking'));
    }

    

    
}
