<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $with = ['image'];

    protected $fillable = [
        'name',
        'description',
        'map_url',
        'information',
        'category_id',
    ];

    public function image()
    {
        return $this->morphOne(FacilityImage::class, 'imageable');
    }
}
