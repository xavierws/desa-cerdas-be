<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_id'
    ];

//    protected $with = ['officials'];

    public function Officials()
    {
        return $this->hasMany(OrganizationOfficial::class);
    }

    public function type()
    {
        return $this->belongsTo(OrganizationType::class);
    }

    public function getTypeAttribute()
    {
        return $this->type()->name;
    }
}
