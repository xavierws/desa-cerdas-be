<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationOfficial extends Model
{
    use HasFactory;

    protected $fillable = [
        'occupation',
        'name',
        'organization_id',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function getOrganizationAttribute()
    {
        return $this->organization->name;
    }
}
