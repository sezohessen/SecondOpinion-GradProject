<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table    = 'reviews';
    protected $fillable=[
        'comment',
        'rating',
        'doctor_id',
        'patient_id',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class,"patient_id");
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,"doctor_id");
    }
}
