<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'employee'; // Your table name

    // Specify which attributes are mass assignable
    protected $fillable = [
        'firstname',
        'lastname',
        'date_of_birth',
        'education_qualification',
        'address',
        'email',
        'phone',
        'photo_url',
        'resume_url',
    ];

    // Specify which attributes should be hidden for arrays
    protected $hidden = [
        // add hidden attributes here if needed
    ];

    // Specify which attributes should be cast to native types
    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
