<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'view_order',
        'sku_id',
    ];

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}
