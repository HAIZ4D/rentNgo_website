<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $primaryKey = 'carID';

    protected $fillable = [
    'adminID', 'carName', 'carModel', 'carImage', 'carSeat', 'carMileage',
    'plateNumber', 'pricePerDay', 'transmissionType', 'location',
    'availableFrom', 'availableTo', 'fuelType', 'carType', 'availabilityStatus',
    ];

    public function bookings()
{
   return $this->hasMany(Booking::class, 'carID', 'carID');
}

}