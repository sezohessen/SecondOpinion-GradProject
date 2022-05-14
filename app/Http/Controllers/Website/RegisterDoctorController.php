<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Models\City;
use App\Models\Doctor;
use App\Models\Field;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterDoctorController extends Controller
{
    public function register()
    {
        $fields         = Field::all();
        $governorates   = Governorate::all();
        return view('auth.doctor_register',compact('fields','governorates'));
    }
    public function create(StoreDoctorRequest $request)
    {
        /* dd($request->city_id); */
        $user = User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password)
        ]);
        if($request->phone)$user->phone = $request->phone;
        if($request->whats_app)$user->whats_app = $request->whats_app;
        $user->save();
        $doctor     = Doctor::create([
            'user_id'       => $user->id,
            'active'        => 1,
            'field_id'      => $request->field_id,
            'governorate_id'=> $request->governorate_id,
            'city_id'       => $request->city_id
        ]);
        $image_id       = add_Image($request->file('avatar'),$doctor->avatar_id,Doctor::Avatar,$update = NULL);
        $doctor->avatar_id = $image_id;
        $doctor->save();
        $user->attachRole(User::DoctorRole);
        auth()->login($user);
        session()->flash('success',__("Register Successfully"));
        return redirect()->route('doctor.account');
    }
    public function showCities($id)
    {
        $cities = City::where('governorate_id', $id)->get();
        if($cities->count() > 0 ){
            return response()->json([
                'cities' => $cities
            ]);
        }
        return response()->json([
            'cities' => null
        ]);
    }
}
