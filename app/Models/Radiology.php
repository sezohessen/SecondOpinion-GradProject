<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiology extends Model
{
    use HasFactory;
    protected $fillable=[
        "desc",
        "reviewed",
        "doctor_id",
        "patient_id",
        "center_id"

    ];
    public function doctor(){
        return $this->belongsTo(Doctor::class,"doctor_id");
    }
    public function patient(){
        return $this->belongsTo(Patient::class,"patient_id");
    }
    public function center(){
        return $this->belongsTo(Center::class,"center_id");
    }
}
