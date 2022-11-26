<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GatewayCurrency extends Model
{
    use HasFactory;
    
    protected $casts = ['status' => 'boolean'];
    protected $guarded = ['id'];

    
    // Relation
    public function media()
    {
        return $this->morphOne(Media::class, 'model');
    }
    
    public function method()
    {
        return $this->belongsTo(Gateway::class);
    }

    public function currencyIdentifier()
    {
        return $this->name ?? $this->method->name . ' ' . $this->currency;
    }

    public function scopeBaseCurrency()
    {
        return $this->method->crypto == 1 ? 'USD' : $this->currency;
    }

    public function scopeBaseSymbol()
    {
        return $this->method->crypto == 1 ? '$' : $this->symbol;
    }

    public function scopeMethodImage()
    {
        return ($this->image) ? getImage(imagePath()['gateway']['path'] .'/' . $this->image) : (($this->method->image) ? getImage(imagePath()['gateway']['path'] . '/' . $this->method->image):  asset(imagePath()['image']['default']));
    }
}
