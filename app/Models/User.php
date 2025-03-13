<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'role',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

       //GET EACH USER DETAILS
       public function details()
       {
           return $this->hasOne(Customer::class, 'user_id', 'uuid');
       }

        // INSERT INTO CUSTOMER/DATABASE
        public function Customer()
        {       //user_id
        return $this->hasOne(Customer::class, 'uuid');   //CONNECTED INTO  Customer  MODEL
        }
  
      
    /**
    * Automatically generate UUID for 'uuid' when creating a new user.
    */
   protected static function boot()
   {
       parent::boot();

       // Hook into the 'creating' event to generate a UUID for the 'uuid' column
       static::creating(function ($user) {
           if (empty($user->uuid)) {
               $user->uuid = (string) Str::uuid();  // Generate and assign UUID
           }
       });
   }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
