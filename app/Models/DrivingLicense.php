<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrivingLicense extends Model
{
    use HasFactory;

    protected $table = 'driving_licenses'; // Explicitly define table name

    protected $primaryKey = 'licenseID'; // Set custom primary key if different from 'id'

    public $timestamps = true; // Enable created_at and updated_at

    protected $fillable = [
        'customerID',
        'licenseNumber',
        'fullName',
        'dateOfBirth',
        'issueDate',
        'expiryDate',
        'licenseClass',
        'countryIssued',
        'licenseImage',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID', 'customerID');
    }
}
