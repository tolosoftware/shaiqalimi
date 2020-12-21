<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    protected $fillable = [
        'type',
        'prefix',
        'integer'
    ];
}
