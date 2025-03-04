<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    

    public function createProduct(Request $request){

        try{
            return response()->json([
            
                'result' => "Product success  created",
            ], 200); // Return 201 for resource created
        }catch(\Exeception $e){
            return response()->json([
            
                'message' => "something went wrong",
            ], 500); // Return 201 for resource created
        }
    }
}
