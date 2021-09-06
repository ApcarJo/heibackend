<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{

    protected $fillable = [
        'name',
        'address',
        'tvCompound',
        'contact',
        'contactPhone',
        'docsLink',
        'isActive',
        'isGLT',
        'isRobot',
        'rraCover',
        'information',
    ];
    public function gwschedule(){
        return $this->hasMany(Gwschedule::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }
    
    use HasFactory;
}
