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
        'isActive'
    ];

    public function stadium(){
        return $this->hasOne(Stadium::class);
    }

    public function matchgw(){
        return $this->hasMany(Matchgw::class);
    }


    use HasFactory;
}
