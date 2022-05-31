<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    const Success  = 1;
    protected $table    = 'payments';
    protected $fillable=[
        'doctor_id',
        'patient_id',
        'center_id',
        'price',
        'status'
    ];
}
