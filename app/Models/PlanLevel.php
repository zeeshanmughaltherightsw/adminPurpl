<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'commission',
        'plan_id',
    ];

    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
