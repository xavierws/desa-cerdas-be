<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataCategory extends Model
{
    use HasFactory;

    protected $table = 'wisata_category';
    
    protected $fillable = [
        'id',
        'name',
    ];
}
