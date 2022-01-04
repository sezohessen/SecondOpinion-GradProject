<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table    = 'patients';
    protected $fillable=[
        'national_id',
        'date_of_birth',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
