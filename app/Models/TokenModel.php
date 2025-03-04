<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // Correct namespace for the Notifiable trait
use Laravel\Sanctum\HasApiTokens;

class TokenModel extends Authenticatable
{
    
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "tbl_core_apitoken"; // tokenModel
    protected $guard = "apisToken";  //Authenticated
}
