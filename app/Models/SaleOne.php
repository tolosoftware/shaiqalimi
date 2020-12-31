<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleOne extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_ones';

    protected $fillable = [
        'sales_id',
        'serial_no',
        'storage_id',
        'destination',
        'transport_cost',
        'service_cost',
        'tax',
        'deposit',
        'total',
        'steps',
        'description',
    ];

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id');
    }

}
