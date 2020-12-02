<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        's_number',
        'issue_date',
        'issue_address',
        'source_address',
        'title',
        'auth_number',
        'type',
        'price',
        'duration',
        'offer_date',
        'close_date',
        'offer_price',
        'project_price',
        'announce_id',
        'organization_id',
        // 'status',
        // 'progress',

    ];
}
