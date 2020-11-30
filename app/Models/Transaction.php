<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // get all from transaction
    protected $fillable = [
        'deal_serial_number',
        'deal_currency',
        'deal_amount',
        'deal_date',
        'deal_status',
        'deal_title',
        'deal_debit_account',
        'deal_dbt_acnt_desc',
        'deal_credit_account',
        'deal_crdt_acnt_desc',
        'deal_description'
    ];
}
