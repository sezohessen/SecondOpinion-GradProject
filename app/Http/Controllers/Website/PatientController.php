<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\DoctorFeedback;
use App\Models\Radiology;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function showComplete()
    {
        $page_title = __('Completed radiology');
        $radiology  = Radiology::where('reviewed',1)
        ->whereHas('patient',function($q){
            $q->where('patients.user_id',Auth()->user()->id);
        })
        ->orderBy('id','desc')
        ->paginate(8);
        return view('website.patient_show_completed',compact('page_title','radiology'));
    }
    public function Complete($id)
    {
        $page_title = __('Show radiology');
        $radiology  = Radiology::where('id',$id)
        ->where('reviewed',1)
        ->whereHas('patient',function($q){
                $q->where('patients.user_id',Auth()->user()->id);
        })->first();
        $feedback   = DoctorFeedback::where('radiology_id',$radiology->id)->first();
        if($radiology){
            return view('website.patient_show_radiology',compact('page_title','radiology','feedback'));
        }else{
            return redirect()->back();
        }


    }
}
