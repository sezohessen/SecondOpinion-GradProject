<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCenterRequest;
use App\Models\Center;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterCenterController extends Controller
{
    public function register()
    {
        $governorates   = Governorate::all();
        return view('auth.center_register',compact('governorates'));
    }
    public function create(StoreCenterRequest $request)
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
        $center     = Center::create([
            'user_id'       => $user->id,
            'governorate_id'=> $request->governorate_id,
            'city_id'       => $request->city_id
        ]);
        $image_id       = add_Image($request->file('avatar'),$center->avatar_id,Center::Cover,$update = NULL);
        $center->cover_id = $image_id;
        $center->save();
        $user->attachRole(User::CenterRole);
        auth()->login($user);
        session()->flash('success',__("Register Successfully"));
        return redirect()->route('Website.Index');
    }
}
