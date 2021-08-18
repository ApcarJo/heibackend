<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{

    protected $fillable = [
        'name',
        'customNote',
        'model',
        'serialNumber',
        'year',
        'warrantyExpiracyDate',
        'quantity',
        'crossCheckCode',
        'type',
        'user_id',
        'loomNumber',
        'kit_van_id',
    ];

    public function van(){
        return $this->belongsTo(Van::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    use HasFactory;
}
