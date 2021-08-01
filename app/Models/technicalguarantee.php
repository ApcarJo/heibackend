<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\technicalguarantee as Authenticatable;
use Laravel\Passport\HasApiTokens;

class technicalguarantee extends Authenticatable
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
        'password'

    ];

    protected $hidden = [
        'isActive',
        'isAvailable'
    ];

    // public function party(){
    //     return $this->hasMany(Party::class);
    // }

    use HasFactory, HasApiTokens;
}

?>
