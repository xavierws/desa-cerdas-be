<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

//    protected $with = ['officials'];

    public function Officials()
    {
        return $this->hasMany(OrganizationOfficial::class);
    }
}
