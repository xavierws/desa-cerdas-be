<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'status',
        'resident_id',
        'merchant_id',
    ];

    protected $with = ['carts.product'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
