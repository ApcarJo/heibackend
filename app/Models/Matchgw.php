<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchgw extends Model
{
    protected $fillable = [
        'gwschedule_id',
        'team_id',
        'isActive'
    ];

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function gwschedule(){
        return $this->belongsTo(gwschedule::class);
    }


    use HasFactory;
}
