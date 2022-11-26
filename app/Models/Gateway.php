<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gateway extends Model 
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'input_form' => 'array',
    ];

    public function media()
    {
        return $this->morphOne(Media::class, 'model');
    }

    public function single_currency()
    {
        return $this->hasOne(GatewayCurrency::class)->latest();
    }

    public function scopeManual()
    {
        return $this->where('is_manual', 1);
    }
}
