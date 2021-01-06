<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    //
    protected $fillable = [
        'datetime',
        'serial_no',
        'title',
        'supervisor',
        'description',
        'user_id',
        
        'destination',
        'transit',
        'scale',
        'others',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
