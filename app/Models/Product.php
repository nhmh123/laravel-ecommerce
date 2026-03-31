<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'brand_id',
        'product_type_id',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'category_product');
    }
}
