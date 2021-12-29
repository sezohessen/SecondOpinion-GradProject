<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiology extends Model
{
    use HasFactory;
    protected $fillable=[
        "desc",
        "doctor_id",
        "patient_id",
        "center_id"
       
    ];
}
