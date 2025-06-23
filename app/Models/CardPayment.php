<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardPayment extends Model
{
    protected $primaryKey = 'carID';
    protected $fillable = [
        'id',
        'paymentID',
        'cardNumber',
        'securityCode',
        'expiryDate',
        'cardHolderName'
    ];
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
