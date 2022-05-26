<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfrastrukturList extends Model
{
    use HasFactory;

    protected $table = 'infrastruktur_list';
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'thumbnail_url',
        'map_url',
        'information',
        'infrastruktur_category_id'
    ];
    public function category(){
        return $this->hasOne(InfrastrukturCategory::class,'id','infrastruktur_category_id');
    }
}
