<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    const Avatar        = '/img/Doctors/';
    protected $table    = 'doctors';
    protected $fillable=[
        'active',
        'national_id',
        'brief_desc',
        'brief_desc_ar',
        'field_id',
        'avatar_id',
        'user_id',
        'facebook'
    ];
}
