<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van extends Model
{

    protected $fillable = [
        'customNote',
        'model',
        // 'assestVan_Id',
        'licensePlate',
        'crossCheckCode',
        'ITV',
        'weight',
        'height',
        'gas',
        'bastidor',
        'lastInspectionDate',
        'KMs',
        'isActive',
    ];

    public function asset(){
        return $this->hasMany(Asset::class);
    }

    public function gwschedule(){
        return $this->hasOne(Gwschedule::class);
    }

    public function vangw(){
        return $this->hasMany(Vangw::class);
    }

    use HasFactory;
}
