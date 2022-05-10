<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataList extends Model
{
    use HasFactory;

    protected $table = 'wisata_list';
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'thumbnail_url',
        'map_url',
        'web_url',
        'phone',
        'information',
        'wisata_category_id'
    ];
    public function category(){
        return $this->hasOne(WisataCategory::class,'id','wisata_category_id');
    }
}
