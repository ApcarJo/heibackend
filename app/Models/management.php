<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class management extends Model
{

    protected $fillable = [
        'phone',
        'address',
        'dni',
        'picture',
        'email',
        'city',
        'postalCode',
        'driverLicense',

    ];

    protected $hidden = [
        'isActive',
        'isAvailable'
    ];

    // public function party(){
    //     return $this->hasMany(Party::class);
    // }

    use HasFactory;
}
