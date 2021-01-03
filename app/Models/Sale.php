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
    public function saleS2()
    {
        return $this->hasOne(SaleTwo::class, 'sales_id');
    }
    public function saleS3()
    {
        return $this->hasOne(SaleThree::class, 'sales_id');
    }
    public function saleS4()
    {
        return $this->hasOne(SaleFour::class, 'sales_id');
    }
    public function source()
    {
        return $this->belongsTo(Storage::class, 'source_id');
    }
}
