<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = [
        'title',
        'formula',
        'description'
    ];

    public function stock_records()
    {
        return $this->hasMany(StockRecord::class, 'operation_id');
    }
}
