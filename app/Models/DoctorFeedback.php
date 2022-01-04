<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorFeedback extends Model
{
    use HasFactory;
    protected $table="doctor_feedback";
    const Files        = '/img/DoctorFeedback/';
    protected $fillable=[
        "doctor_id",
        "radiology_id",
        "patient_id",
        "pdf_report",
        "desc"

    ];
}
