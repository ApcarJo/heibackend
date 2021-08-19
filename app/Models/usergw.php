<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usergw extends Model
{

    protected $fillable = [
        'user_id',
        'userTeam_id',
        'timeStart',
        'timeFinish',
        'MD'
    ];

    
    public function userTeam(){
        return $this->belongsTo(userTeam::class);
    }

    public function user(){
        return $this->belongTo(User::class);
    }

    use HasFactory;
}
