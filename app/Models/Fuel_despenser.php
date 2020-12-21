<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuel_despenser extends Model
{

    protected $fillable = [
        'station_id',
        'name'
    ];

    public function fuel_station()
    {
        return $this->belongsTo(Fuel_station::class, 'station_id');
    }
}
