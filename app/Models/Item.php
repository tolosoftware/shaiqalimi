<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'type_id',
        'name',
        'min_uom_id',
        'sub_oum_id',
        'unit_equivalent',
        'description',
    ];
    public function stock_records()
    {
        return $this->hasMany(StockRecord::class, 'item_id');
    }
    public function type()
    {
        return $this->belongsTo(ItemType::class, 'type_id');
    }
    public function measurment_unites_min()
    {
        return $this->belongsTo(MeasurmentUnit::class, 'min_uom_id');
    }
    public function measurment_unites_sub()
    {
        return $this->belongsTo(MeasurmentUnit::class, 'sub_oum_id');
    }
}
