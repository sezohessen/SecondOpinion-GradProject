<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologyFile extends Model
{
    use HasFactory;
    protected $fillable=[
        "radiology_id",
        "image_id",

    ];
}
