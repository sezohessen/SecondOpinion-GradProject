<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    const Avatar        = '/img/Doctors/';
    const DefaultAvatar = '/img/Doctors/doctor.png';
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
    public static function rules($edit_profile=null)
    {

        $rules = [
            'national_id'        => 'nullable|unique:doctors,national_id,'.$edit_profile,
            'facebook'           => 'nullable|url',
            'brief_desc'         => 'required|string',
            'brief_desc_ar'      => 'required|string',
            'avatar_id'          => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'field_id'           => 'nullable',
        ];
        if($edit_profile){
            $rules['avatar_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }
        return $rules;
    }
    public static function credentials($request,$user,$avatar_id=null)
    {
        $credentials = [
            'brief_desc'                => $request->brief_desc,
            'brief_desc_ar'             => $request->brief_desc_ar,
            'active'                    => 1,
            'user_id'                   => $user
        ];
        if ($request->national_id){
            $credentials['national_id'] =$request->national_id;
    }
        if ($request->facebook){
            $credentials['facebook'] =$request->facebook;
        }
        if($request->file('avatar_id')){
            if($avatar_id){
                $Image_id = file_encode($request->file('avatar_id'),self::Avatar,$avatar_id);
            }else {
                $Image_id = file_encode($request->file('avatar_id'),self::Avatar);
            }
            $credentials['avatar_id'] = $Image_id;
        }
        return $credentials;
    }
    public function avatar(){
        return $this->belongsTo(Image::class,"avatar_id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function field(){
        return $this->belongsTo(Field::class,"field_id");
    }
}
