<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment_bookings'; // ✅ Tell Laravel the actual table name
    protected $fillable = [
        'paymentID',
        'amount',
        'methodPayment',
        'paymentStatus',
        'paymentDate',
        'bookingID',
        'name',
        'bankName',
        'accountNumber',
    ];
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookingID');
    }
    public function card()
    {
        return $this->hasOne(CardPayment::class);
    }
}
