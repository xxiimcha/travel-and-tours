<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelBookingController extends Controller
{   
    public function show($id) {
        $booking = Hotel::find($id);
        if (!$booking) {
            abort(404, 'Hotel not found');
        }

        return view('admin.components.view-hotel', compact('booking'));
    }
    public function edit($id){
        $booking = Hotel::find($id);
        if (!$booking) {
            abort(404, 'Hotel not found');
        }
        return view('admin.components.view-hotel-edit',compact('booking'));
    }
}
