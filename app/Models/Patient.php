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
    public static function rules()
    {

        $rules = [
            'national_id'        => 'nullable|string|digits:14',
            'date_of_birth'         => 'nullable|date',
        ];

        return $rules;
    }
    public static function credentials($request,$user)
    {
        $credentials = [
            'national_id'            => $request->national_id,
            'date_of_birth'             => $request->date_of_birth,
            'user_id'  => $user,
        ];
        return $credentials;
    }

}
