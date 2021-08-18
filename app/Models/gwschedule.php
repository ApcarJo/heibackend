<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gwschedule extends Model
{
    protected $fillable = [
        'date',
        'competition',
        'gw',
        'home',
        'away',
        'kickOff',
        'stadium_id',
        'van_id',
        'tg1_user_id',
        'tg2_user_id',
        'vtg_user_id',
        'ro_user_id',
        'aro_user_id',
        'isMd-1',
        'vlan',
        'port',

    ];
    
    public function stadium(){
        return $this->belongsTo(Stadium::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

    use HasFactory;
}
