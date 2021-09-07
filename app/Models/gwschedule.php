<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gwschedule extends Model
{
    protected $fillable = [
        'gw',
        'competition',
        'date',
        'kickOff',
        'stadium_id',
        // 'userTeam_id',
        // 'matchgw_id'
        // 'vanGW_id',
        'isMd-1',
        'vlan',
        'port',
        'isActive',
        'isArchive',

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
