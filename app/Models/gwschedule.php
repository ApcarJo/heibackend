<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gwschedule extends Model
{
    protected $fillable = [
        'GW',
        'Competition',
        'date',
        'kickOff',
        'stadium_id',
        'userTeam_id',
        'matchgw_id',
        'vanGW_id',
        'isMd-1',
        'vlan',
        'port',
        'isActive',
        'isArchive',

    ];

    public function stadium(){
        return $this->hasMany(stadium::class);
    }

    public function matchgw(){
        return $this->hasMany(Matchgw::class);
    }

    public function userTeam(){
        return $this->hasMany(userTeam::class);
    }

    public function vangw(){
        return $this->hasMany(Vangw::class);
    }

    use HasFactory;
}
