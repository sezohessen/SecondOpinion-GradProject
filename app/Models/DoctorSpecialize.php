<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialize extends Model
{
    use HasFactory;
    protected $table    = 'doctor_specializes';
    protected $fillable=[
        'doctor_id',
        'specialize_id',
    ];
}
