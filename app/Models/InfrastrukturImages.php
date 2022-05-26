<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfrastrukturImages extends Model
{
    use HasFactory;

    protected $table = 'infrastruktur_images';
    
    protected $fillable = [
        'id',
        'image_url',
        'infrastruktur_list_id',
    ];
}