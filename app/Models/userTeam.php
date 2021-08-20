<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userTeam extends Model
{

    protected $fillable=[
        'gwschedule_id',
        'user_owner_id',
        'isActive'
    ];

    public function usergw(){
        return $this->hasMany(usergw::class);
    }

    public function gwschedule(){
        return $this->belongsTo(Gwschedule::class);
    }
    use HasFactory;
}
