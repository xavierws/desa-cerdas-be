<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityCategory extends Model
{
    use HasFactory;

    protected $with = ['image'];

    protected $fillable = [
        'name'
    ];

    public function image()
    {
        return $this->morphOne(FacilityImage::class, 'imageable');
    }
}
