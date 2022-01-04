<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Radiology;
use Illuminate\Http\Request;

class DoctorRadiologyController extends Controller
{
    public function index()
    {
        $page_title = __('Pending radiology');
        $radiology  = Radiology::where('reviewed',0)
        ->whereHas('doctor',function($q){
            $q->where('doctors.user_id',Auth()->user()->id);
        })->paginate(8);
        return view('Doctor.pending',compact('page_title','radiology'));
    }
    public function completed()
    {
        $page_title = __('Completed radiology');
        $radiology  = Radiology::where('reviewed',1)
        ->whereHas('doctor',function($q){
            $q->where('doctors.user_id',Auth()->user()->id);
        })->paginate(8);
        return view('Doctor.completed',compact('page_title','radiology'));
    }
    public function feedback($id)
    {
        $page_title = __('Radiology feedback');
        $radiology  = Radiology::findOrFail($id);

        return view('Doctor.feedback',compact('page_title','radiology'));
    }
}
