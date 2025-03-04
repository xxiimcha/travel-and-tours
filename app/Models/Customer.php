<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'tbl_core_customer'; // Specify the table name

    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'address', 'gender', 'email', 'phone_number', 'user_images'
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
