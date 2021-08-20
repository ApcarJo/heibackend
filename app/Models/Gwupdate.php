<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gwupdate extends Model
{

    protected $fillable = [
        'name',
        'date',
        'generalInfo',
        'technicalUpdate',
        'hardwareUpdate',
        'operationalUpdate',
        'logisticsUpdate',
        'usefullInformation',
        'links',
        'isActive',
    ];


    use HasFactory;
}
