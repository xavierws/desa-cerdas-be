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

    protected $with = ['image'];

    public function Officials()
    {
        return $this->hasMany(OrganizationOfficial::class);
    }

    public function type()
    {
        return $this->belongsTo(OrganizationType::class);
    }

    public function image()
    {
        return $this->hasOne(OrganizationImage::class);
    }

    public function getTypeNameAttribute()
    {
        return $this->type->name;
    }
}
