<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects_Step extends Model
{
    protected $table = 'projects_step';
    public $timestamps = false;
    protected $fillable = [
        'step',
        'project_id',
        'is_ekmalat_allowed',
        'mactob_sending',
        'adminis_prove',
        'finishcontract',
        'statusActive'
    ];
}
