<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales';

    protected $fillable = [
        'type',
        'source_id',
        'source_type',
        'user_id',
        'currency_id',
        'datatime',
    ];

    public function saleS1()
    {
        return $this->hasOne(SaleOne::class, 'sales_id');
    }
    public function source()
    {
        return $this->belongsTo(Project::class, 'source_id');
    }
}
