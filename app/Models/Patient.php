<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table    = 'patients';
    protected $fillable=[
        'national_id',
        'date_of_birth',
        'user_id',
    ];
    use HasFactory;
}
