<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback_booking extends Model
{
    protected $primaryKey = 'feedbackID';
    public $incrementing = false; // if feedbackID is not auto-incrementing
    protected $keyType = 'string'; // or 'int', depending on your column type

    protected $fillable = ['bookingID', 'comment', 'rating', 'dateSubmitted', 'customerID'];


public function booking()
{
    return $this->belongsTo(Customer::class, 'bookingID','bookingID');
}
}