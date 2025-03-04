<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    // SHOW REGISTRATION VIEW
    public function showRegistrationForm()
    {
        return response(view('register'))->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                                         ->header('Pragma', 'no-cache');
    }

    // REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:30',
            'lastname' => 'required|string|max:30',      
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|string|min:8|confirmed', // Ensure passwords match
        ]);

        $data = new User;
        $data->firstname = $request->firstname;
        $data->lastname = $request->lastname;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);  // Hashing the password
        $data->save();

        // Flash success message to the session
        return redirect()->route('login')->with('success', 'Your account has been successfully created.');
    }

    // SHOW LOGIN VIEW
    public function showLoginForm()
    {
        return response(view('login'))->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                                      ->header('Pragma', 'no-cache');
    }

    // LOGIN USER
    public function login_user(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required']
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $fields['email'], 'password' => $fields['password']])) {
            // Authentication successful, redirect to dashboard or any other route
            return redirect()->route('home');
        } else {
            // Authentication failed, return back with an error message
            return back()->withErrors([
                'failed' => 'Invalid credentials provided.',
            ])->onlyInput('email'); // Keep the email input to avoid refilling
        }
    }

    // LOGOUT USER
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}
