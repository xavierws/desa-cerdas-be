<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'address',
        'city',
        'province',
        'postal_code',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function merchant()
    {
        return $this->hasOne(Merchant::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
