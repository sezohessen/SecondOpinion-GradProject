<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    const Success  = 1;
    public static function statusCode(){
        return [
            0=>"accepted",
            1=>"pending",
            2=>"rejected",
            3=>"canceled"
        ];
    }
    protected $table    = 'payments';
    protected $fillable=[
        'doctor_id',
        'patient_id',
        'center_id',
        'price',
        'statusCode',
        'transactionId'
    ];
}
