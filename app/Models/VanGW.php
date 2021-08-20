<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vangw extends Model
{
    protected $fillable = [
        'gwschedule_id',
        'van_id',
        'isActive',
    ];

    public function van()
    {
        return $this->belongsTo(Van::class);
    }

    public function gwschedule()
    {
        return $this->belongsTo(gwschedule::class);
    }

    use HasFactory;
}
