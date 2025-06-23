<?php

namespace App\Models;
use App\Models\Car;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'bookingID';

    protected $fillable = [
        'carID', 'adminID', 'customerID', 'pickupDate', 'returnDate', 'pickupLocation', 'dropOffLocation',
        'bookingStatus', 'totalAmount', 'isLateReturn', 'lateFee', 'date'
    ];

    public function car()
    {
         return $this->belongsTo(Car::class, 'carID', 'carID');
    }
     public function feedback()
{
    return $this->hasOne(Feedback_booking::class, 'bookingID', 'bookingID');

}
}
