<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AuthMiddlewareController;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
             
        $middleware->alias([
            
            'guest.redirect' => \App\Http\Middleware\AuthMiddlewareController::class,
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'auth.basic'	=> \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' =>	\Illuminate\Session\Middleware\AuthenticateSession::class,
            'cache.headers' =>	\Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' =>	\Illuminate\Auth\Middleware\Authorize::class,
            'guest' =>	\Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' =>	\Illuminate\Auth\Middleware\RequirePassword::class,
            'precognitive' =>	\Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            'signed' =>	\Illuminate\Routing\Middleware\ValidateSignature::class,
            'subscribed' =>	\Spark\Http\Middleware\VerifyBillableIsSubscribed::class,
            'throttle'	=> \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' =>	\Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
