<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StockRecord extends Model
{
    protected $fillable = [
        'type',
        'type_id',
        'source',
        'source_id',
        'item_id',
        'increment',
        'decrement',
        'uom_id',
        'increment_equiv',
        'decrement_equiv',
        'uom_equiv_id',
        'density',
        'operation_id',
        'remark'
    ];
    public function operation()
    {
        return $this->belongsTo(Operation::class, 'operation_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function measur_unit()
    {
        return $this->belongsTo(MeasurmentUnit::class, 'uom_equiv_id');
    }
}
