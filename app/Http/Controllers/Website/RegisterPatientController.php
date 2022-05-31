<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterPatientController extends Controller
{
    public function create(StorePatientRequest $request)
    {
        $user = User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password)
        ]);
        if($request->phone)$user->phone = $request->phone;
        if($request->whats_app)$user->whats_app = $request->whats_app;
        $user->save();
        Patient::create([
            'user_id'       => $user->id,
            'date_of_birth' => date('Y-m-d',strtotime($request->year.'/'.$request->month.'/'.$request->day)),
        ]);
        $user->attachRole(User::PatientRole);
        auth()->login($user);
        session()->flash('created',__("Register Successfully, Search for doctor"));
        return redirect()->route('Website.page.doctors');
    }
}
