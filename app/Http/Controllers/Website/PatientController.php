<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\DoctorFeedback;
use App\Models\Image;
use App\Models\Patient;
use App\Models\Radiology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
        $UpdateRad  = Radiology::whereHas('patient',function($q){
            $q->where('patients.user_id',Auth()->user()->id);
        })->update(['patient_seen' => 1]);
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
    public function showPending()
    {
        $page_title = __('Pending radiology');
        $radiology  = Radiology::where('reviewed',0)
        ->whereHas('patient',function($q){
            $q->where('patients.user_id',Auth()->user()->id);
        })
        ->orderBy('id','desc')
        ->paginate(8);

        return view('website.patient_show_pending',compact('page_title','radiology'));
    }
    public function Pending($id)
    {
        $page_title = __('Show radiology');
        $radiology  = Radiology::where('id',$id)
        ->where('reviewed',0)
        ->whereHas('patient',function($q){
                $q->where('patients.user_id',Auth()->user()->id);
        })->first();
        $feedback   = DoctorFeedback::where('radiology_id',$radiology->id)->first();
        if($radiology){
            return view('website.patient_show_pending_radiology',compact('page_title','radiology','feedback'));
        }else{
            return redirect()->back();
        }
    }
    public function DownloadFile($id,$radiology_id)//Image ID
    {
        $radiology  = Radiology::FindOrFail($radiology_id);
        /* Very important line for security */
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $patientID   = Patient::where('user_id',Auth()->user()->id)->first();
        if($patientID->id!=$radiology->patient_id)return redirect()->back();
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $image      = Image::FindOrFail($id);
        $file_path  = storage_path('app/public').'/'.$image->base.'/'.$image->name;
        if(file_exists($file_path))return Response::download($file_path);
        else{
            session()->flash('notfound',__("Sorry, File not found"));
            return redirect()->back();
        }
    }
    public function DownloadReport($id)
    {
        $feedback       = DoctorFeedback::FindOrFail($id);
        $patientID      = Patient::where('user_id',Auth()->user()->id)->first();
        if($feedback->patient_id!=$patientID->id)return redirect()->back();
        $path           = storage_path('app').DoctorFeedback::Files.$feedback->pdf_report;
        $name           = $feedback->patient->user->getFullNameAttribute().$feedback->pdf_report;
        if (file_exists($path)) return Response::download($path,$name);
        else return redirect()->back();
    }
}
