<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfrastrukturCategory extends Model
{
    use HasFactory;

    protected $table = 'infrastruktur_category';
    
    protected $fillable = [
        'id',
        'name',
    ];
}
