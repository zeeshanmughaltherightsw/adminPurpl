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
        'price',
        'estimated_profit',
        'amount_returns',
        'status'
    ];
}
