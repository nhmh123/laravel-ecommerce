<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatusRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_quantity',
        'max_quantity',
        'status_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
