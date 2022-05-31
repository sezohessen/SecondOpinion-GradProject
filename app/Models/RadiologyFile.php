<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologyFile extends Model
{
    use HasFactory;
    const patient_radiology_path = 'patient_radiology';
    protected $fillable=[
        "radiology_id",
        "image_id",

    ];
    public function image()
    {
        return $this->belongsTo(Image::class,'image_id','id');
    }
}
