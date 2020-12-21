<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $fillable = [
        'name',
        'address',
        'manager',
        'phone',
        'description'
    ];
}
