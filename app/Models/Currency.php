<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sign_en',
        'sign_fa',
    ];
}
