<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name',
        'min_ref',
        'max_ref',
        'ref_commission',
        'price',
        'min_profit',
        'max_profit',
        'plan_type',
        'amount_returns',
        'status'
    ];

    public function changeStatus()
    {   
        $this->status = !$this->status;
        return $this;
    }
}
