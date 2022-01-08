<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFeedBackRequest;
use App\Models\Doctor;
use App\Models\DoctorFeedback;
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
    public function givefeedback(CreateFeedBackRequest $request,$id)
    {
        $validated  = $request->validated();
        $DoctorID   = Doctor::where('user_id',Auth()->user()->id)->first();
        $radiology  = Radiology::FindOrFail($id);
        if($radiology->doctor_id!=$DoctorID->id)return redirect()->back();
        $feedback   = DoctorFeedback::create([
            'desc'          => $request->desc,
            'doctor_id'     => $DoctorID->id,
            'radiology_id'  => $radiology->id,
            'patient_id'    => $radiology->patient_id
        ]);
        $file      = $request->hasFile('file');
        if($file){
            $file  = $request->file('file');
            $this->uploadFeedbackFile($file,$feedback);
        }
        /* Make the radiology request as reviewed */
        $radiology->reviewed = Radiology::reviewed;
        $radiology->save();

        session()->flash('created',__("Feedback has been sent successfully"));
        return redirect()->route("doctor.completed.radiology");
    }
    public function uploadFeedbackFile($file,$feedback)
    {
        $filenameWithExt        = $file->getClientOriginalName();
        $filename               = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension              = $file->getClientOriginalExtension();
        $fileNameToStore        = $filename.'_'.time().'.'.$extension;
        $path                   = $file->storeAs('public/feedback',$fileNameToStore);
        $feedback->pdf_report   = $fileNameToStore;
        $feedback->save();
    }
    public function show($id)
    {
        $page_title = __('Show radiology');
        $radiology  = Radiology::FindOrFail($id);
        /* Very important line for security */
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $DoctorID   = Doctor::where('user_id',Auth()->user()->id)->first();
        if($DoctorID->id!=$radiology->doctor_id)return redirect()->back();
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */

        return view('Doctor.show_radiology',compact('page_title','radiology'));
    }
}
