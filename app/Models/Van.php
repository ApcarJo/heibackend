<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van extends Model
{

    protected $fillable = [
        'vanNumber',
        'model',
        'assestsVan_Id',
        'licensePlate',
        'crossCheckCode',
        'ITV',
        'weight',
        'height',
        'gas',
        'bastidor',
        'lastInspectionDate',
        'isActive',
    ];

    public function assetsVan(){
        return $this->hasMany(Assets::class);
    }

    use HasFactory;
}
