<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $fillable = [
        'title',
        'type_id',
        'system'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class, 'type_id');
    }
}
