<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'trx',
        'trx_type',
        'trx_type',
        'user_id',
        'reward',
        'ref_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commissionRecord()
    {
        return $this->hasMany(CommissionRecord::class);
    }
}
