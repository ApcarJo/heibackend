<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VanGW extends Model
{
    protected $fillable = [
      'gwschedule_id',
      'van_id'  
    ];

    public function van(){
        return $this->belongsTo(Van::class);
    }

    public function gwschedule(){
        return $this->belongsTo(gwschedule::class);
    }
    
    use HasFactory;
}
