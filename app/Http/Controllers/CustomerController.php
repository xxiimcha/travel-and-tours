<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Ensure this is included


use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return view('index');
    }
    public function tour_package(){
        return view('tour-package-details');
    }
    public function rentals(){
        return view('transport-booking');
    }
    public function hotel_resevation(){
        return view('hotel-reservation');
    }
    public function flights(){
        return view('flights');
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


    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token
        
        return redirect()->route('home'); // Redirect to the home page or login page
    }



}
