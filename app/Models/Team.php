<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $fillable = [
        'name',
        'isFD',
        'isUCL',
        'isUEL',
        'isSC',
        'isCDR',
        'stadium_id',
    ];

    public function stadium(){
        return $this->hasOne(Stadium::class);
    }

    public function gwschedule(){
        return $this->hasMany(Gwschedule::class);
    }
    use HasFactory;
}
