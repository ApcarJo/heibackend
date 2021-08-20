<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

    protected $fillable = [
        'name',
        'type',
        'model',
        'serialNumber',
        'year',
        'warrantyExpiracyDate',
        'quantity',
        'crossCheckCode',
        'user_id',
        'loomNumber',
        'kit_van_id',
    ];
    
    public function van(){
        return $this->belongsTo(Van::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
