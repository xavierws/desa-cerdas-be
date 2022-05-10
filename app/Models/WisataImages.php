<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataImages extends Model
{
    use HasFactory;

    protected $table = 'wisata_images';
    
    protected $fillable = [
        'id',
        'image_url',
        'wisata_list_id',
    ];
}