<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password', 'position', 'phoneNumber', 'profilePhoto', 'adminCode'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // ✅ This is where you add the accessor
    public function getProfilePictureUrlAttribute()
    {
        if ($this->profilePhoto && \Storage::disk('public')->exists($this->profilePhoto)) {
            return asset('storage/' . $this->profilePhoto);
        }

        return 'https://via.placeholder.com/40'; // fallback if no photo
    }
}
