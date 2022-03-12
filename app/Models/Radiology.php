<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiology extends Model
{
    use HasFactory;
    const reviewed  = 1;
    const base      = '/img/Radiology/';
    protected $fillable=[
        "desc",
        "reviewed",
        "doctor_id",
        "patient_id",
        "seen",
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
    /**
     * Get all of the files for the Radiology
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(RadiologyFile::class, 'radiology_id', 'id');
    }
}
