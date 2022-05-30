<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'province',
        'postal_code',
        'is_approved',
        'resident_id',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
