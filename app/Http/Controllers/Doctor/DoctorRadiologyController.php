<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFeedBackRequest;
use App\Http\Requests\DoctorAccountRequest;
use App\Models\Doctor;
use App\Models\DoctorFeedback;
use App\Models\DoctorSpecialize;
use App\Models\Field;
use App\Models\Image;
use App\Models\Radiology;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpParser\Comment\Doc;

class DoctorRadiologyController extends Controller
{
    public function index()
    {
        $page_title = __('Pending radiology');
        $UpdateRad  = Radiology::whereHas('doctor',function($q){
            $q->where('doctors.user_id',Auth()->user()->id);
        })->update(['doctor_seen' => 1]);
        $radiology  = Radiology::where('reviewed',0)
        ->whereHas('doctor',function($q){
            $q->where('doctors.user_id',Auth()->user()->id);
        })
        ->orderBy('id','desc')
        ->paginate(8);
        return view('Doctor.pending',compact('page_title','radiology'));
    }
    public function completed()
    {
        $page_title = __('Completed radiology');
        $radiology  = Radiology::where('reviewed',1)
        ->whereHas('doctor',function($q){
            $q->where('doctors.user_id',Auth()->user()->id);
        })
        ->orderBy('id','desc')
        ->paginate(8);
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
    public function DownloadFile($id,$radiology_id)//Image ID
    {
        $radiology  = Radiology::FindOrFail($radiology_id);
        /* Very important line for security */
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $DoctorID   = Doctor::where('user_id',Auth()->user()->id)->first();
        if($DoctorID->id!=$radiology->doctor_id)return redirect()->back();
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $image      = Image::FindOrFail($id);
        $file_path = storage_path('app/public').'/'.$image->base.'/'.$image->name;
        if(file_exists($file_path))return Response::download($file_path);
        else{
            session()->flash('notfound',__("Sorry, File not found"));
            return redirect()->back();
        }

        /* $seller     = Seller::find($id);
        $extension  = explode('.',$seller->file);
        $fileName   = $seller->user->full_name . '.' . $extension[1];
        $file       = storage_path('app\files\\') . $seller->file;
        $headers    = array(
            'Content-Type: application/' . $extension[1],
        );
        // dd(1);
        return response()->download($file,$fileName,$headers); */
    }
    public function Account()
    {
        $page_title             = __('My Account');
        $doctor                 = Doctor::where('user_id',Auth()->user()->id)->first();
        $fields                 = Field::all();
        $specialties            = Specialty::all();
        $DoctorSpecialties      = DoctorSpecialize::where('doctor_id',$doctor->id)->get();
        $Selectedspecialties    = [];
        foreach($DoctorSpecialties as $specialty)$Selectedspecialties[] = $specialty->specialize_id;
        return view('Doctor.account',compact('page_title','doctor','fields','specialties','Selectedspecialties'));
    }
    public function Update(DoctorAccountRequest $request)
    {
        $validated              = $request->validated();

        $doctor                 = Doctor::where('user_id',Auth()->user()->id)->first();
        $doctor->brief_desc_ar  = $request->desc_ar;
        if($request->has('desc'))$doctor->brief_desc   = $request->desc;
        if($request->has('facebook'))$doctor->facebook = $request->facebook;
        $doctor->field_id       = $request->field_id;
        if($request->has('avatar')){
            if($doctor->avatar_id)add_Image($request->file('avatar'),$doctor->avatar_id,Doctor::Avatar,$update = 1);
            else{
                $image_id       = add_Image($request->file('avatar'),$doctor->avatar_id,Doctor::Avatar,$update = NULL);
                $doctor->avatar_id = $image_id;
            }
        }
        $doctor->save();
        /* Multiple Select */
        $DoctorSpecialties      = DoctorSpecialize::where('doctor_id',$doctor->id)->get();
        $Selectedspecialties       = [];
        foreach($DoctorSpecialties as $DoctorSpecialty){
            $Selectedspecialties[] = $DoctorSpecialty->specialize_id;
        }
        $NeedToBeDeleted        = array_diff($Selectedspecialties,$request->specialty_id);
        $NeedToBeCreated        = array_diff($request->specialty_id,$Selectedspecialties);

        foreach ($NeedToBeCreated as $Specialty){
            DoctorSpecialize::create([
                'doctor_id'     => $doctor->id,
                'specialize_id' => $Specialty
            ]);
        }
        foreach ($NeedToBeDeleted as $Specialty){
            DoctorSpecialize::where([
                ['doctor_id',$doctor->id],
                ['specialize_id',$Specialty]
            ])->delete();
        }
        session()->flash('success',__("Account has been updated"));
        /* Multiple Select */
        return redirect()->back();
    }
    public function ShowCompleted($id)
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
        $feedback   = DoctorFeedback::where('radiology_id',$radiology->id)->first();
        return view('Doctor.show_completed',compact('page_title','radiology','feedback'));
    }
    public function DownloadReport($id)
    {
        $feedback   = DoctorFeedback::FindOrFail($id);
        $DoctorID   = Doctor::where('user_id',Auth()->user()->id)->first();
        if($feedback->doctor_id!=$DoctorID->id)return redirect()->back();
        $path       = storage_path('app').DoctorFeedback::Files.$feedback->pdf_report;
        $name       = $feedback->patient->user->getFullNameAttribute().$feedback->pdf_report;
        if (file_exists($path)) return Response::download($path,$name);
        else return redirect()->back();
    }
}
