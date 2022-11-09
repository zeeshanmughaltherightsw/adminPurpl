<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name',
        'min_ref',
        'max_ref',
        'ref_commission',
        'min_price',
        'max_price',
        'profit',
        'plan_type',
        'expire',
        'status'
    ];

    public function changeStatus()
    {   
        $this->status = $this->status ? 0 : 1;
        return $this;
    }

    public function level(){
        return $this->hasMany(PlanLevel::class);
    }
}
