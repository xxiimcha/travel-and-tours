<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{

     public function register(Request $request){
        
        
        try{           
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:6|confirmed', // Confirmed for password confirmation
            ]);
    
            // Check if validation fails
            if ($validator->fails()) {
                // Get the errors in the order you want to display them
                $errors = $validator->errors();
                $errorOrder = [
                    'firstname',
                    'lastname',
                    'email',
                    'password',
                ];
    
                // Reorder errors to show 'firstname' error first
                $orderedErrors = [];
                foreach ($errorOrder as $field) {
                    if ($errors->has($field)) {
                        $orderedErrors[$field] = $errors->get($field);
                    }
                }
    
                return response()->json([
                    'status' => false,
                    'message' => 'Validation errors occurred.',
                    'errors' => $orderedErrors,
                ], 422); // Return 422 for validation errors
            }
    
            // Create a new user instance
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password); // Hash the password
    
            // Save the user to the database
            $user->save();
    
            // Generate an API token for the user
            $token = $user->createToken('Auth_Token')->plainTextToken;
    
            // Return a success response with the token
            return response()->json([
                'status' => true,
                'message' => 'Successfully created!',
                'token' => $token,
            ], 201); // Return 201 for resource created
         } catch ( \Throwable $th){
             // Return a success response with the token
             return response()->json([
                'status' => true,
                'message' => $th->getMessage(),
            ], 500); // Return 201 for resource created
         }

        }
    
    public function login(Request $request){
        try{
            $validatorUser = Validator::make($request->all(),
             [
                'email' => 'required',
                'password' => 'required', // Confirmed for password confirmation
            ]);

             // If validation fails, return errors
        if ($validatorUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validator error',
                'errors' => $validatorUser->errors()
            ], 401);
        }

        if(!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email and password does not match with our record!',

            ], 401);
        }
       
        $user = User::where('email',$request->email)->first();
        return response()->json([
            'status' => true,
            'message' => 'User log in success',
            'token' => $user->createToken("Auth_token")->plainTextToken,
            'redirect' => url('/home') // Include redirection URL in response
        ], 200);

        }catch(\throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500); // Return 201 for resource created
        }
    }
    public function profile(){


        $userData =  auth()->user();
        
        return response()->json([
            'status' => true,
            'message' => 'Profile info',
            'data' => $userData,
            'id' => auth()->user()->id,
        ], 200);

    }

    public function logout(){
         auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'successfully logout',
            'data' => []
        ], 200);

    }
}
    


