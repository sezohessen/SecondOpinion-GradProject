<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    const Cover        = '/img/Centers/';
    protected $table    = 'centers';
    protected $fillable=[
        'desc',
        'desc_ar',
        'user_id',
        'cover_id',
        'governorate_id',
        'city_id',
        'street',
    ];
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function cover(){
        return $this->belongsTo(Image::class,"cover_id");
    }
}
