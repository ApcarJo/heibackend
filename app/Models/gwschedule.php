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
        'Matchgw_id',
        'kickOff',
        'stadium_id',
        'userTeam_id',
        'vanGW_id',
        'isMd-1',
        'vlan',
        'port',

    ];

    public function stadium(){
        return $this->belongsTo(stadium::class);
    }

    public function matchgw(){
        return $this->hasOne(Matchgw::class);
    }

    public function userTeam(){
        return $this->hasOne(userTeam::class);
    }

    public function vangw(){
        return $this->hasOne(Vangw::class);
    }

    use HasFactory;
}
