<?php

namespace App\Http\Controllers\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddlewareController extends Controller
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
             // If the user is authenticated, redirect them to the dashboard
             return redirect()->route('home');
        }
        return $next($request);
    }
}
