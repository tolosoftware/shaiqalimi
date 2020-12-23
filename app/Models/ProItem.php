<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProItem extends Model
{
    protected $fillable = [
        'project_id',
        'proposal_id',
        'item_id',
        'unit_id',
        'uom_equiv_id',
        'operation_id',
        'ammount',
        'unit_price',
        'total_price',
        'equivalent'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function m_unit()
    {
        return $this->belongsTo(MeasurmentUnit::class, 'unit_id');
    }
    public function operation()
    {
        return $this->belongsTo(Operation::class, 'operation_id');
    }

}
