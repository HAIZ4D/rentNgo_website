<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $primaryKey = 'customerID';

    protected $fillable = [
        'name',
        'emailAddress',
        'password',
        'phoneNumber',
        'licenseNumber',
        'ICNumber',
        'address',
        'licenseStatus',
        'paymentMethods',
        'profilePhoto',
    ];

    protected $hidden = [
        'password',
    ];

    // If you use remember_token or email verification, add:
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
