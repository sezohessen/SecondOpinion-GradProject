<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookOpinionController extends Controller
{
    public function book($id)
    {
        if(auth()->check()){
            if(auth()->user()->hasRole('patient')){
                $doctor         = Doctor::findOrFail($id);
                $patient        = Patient::where('user_id',auth()->user()->id)->first();
                $date_of_birth  = Carbon::parse($patient->date_of_birth);
                return view('website.getopinion',compact('doctor','date_of_birth'));
            }else{ return redirect()->route('Website.Index');}
        }else{ return redirect()->route('Website.Index');}
    }
    public function store(Request $request)
    {
        dd(1);
    }
}
