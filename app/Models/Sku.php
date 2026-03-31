<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sku_code',
        'slug',
        'price',
        'cost_price',
        'is_service',
        'total_stock',
        'status_id',
        'product_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_service' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
