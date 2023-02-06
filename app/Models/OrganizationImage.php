<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'organization_id',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
