<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gwupdate extends Model
{

    protected $fillable = [
        'date',
        'title',
        'roles',
        'infoUpdate',
        'img',
        'isActive',
    ];


    use HasFactory;
}
