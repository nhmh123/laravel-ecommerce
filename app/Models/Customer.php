<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function defaultAddress()
    {
        return $this->addresses()->where('is_default', true)->first();
    }
}
