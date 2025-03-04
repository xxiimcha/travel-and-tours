<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flights;

class FlightsBookingController extends Controller
{
    public function show($id) {
        $booking = Flights::find($id);
        if (!$booking) {
            abort(404, 'Flights not found');
        }

        return view('admin.components.view-flights', compact('booking'));
    }
    public function edit($id) {
        $booking = Flights::find($id);
        if (!$booking) {
            abort(404, 'Flights not found');
        }
        return view('admin.components.view-flights-edit', compact('booking'));
    }
}
