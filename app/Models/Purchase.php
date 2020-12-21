<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable = [
        'serial_no',
        'vendor_id',
        'date_time',
        'description',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
