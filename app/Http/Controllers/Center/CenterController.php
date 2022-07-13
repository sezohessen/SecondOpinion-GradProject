<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Http\Requests\CenterStoreRadiologyRequest;
use App\Models\Center;
use App\Models\Doctor;
use App\Models\DoctorFeedback;
use App\Models\Image;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Radiology;
use App\Models\RadiologyFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class CenterController extends Controller
{
    public function pending()
    {
        $page_title = __('Pending radiology');
        $radiology  = Radiology::where('reviewed',0)
        ->whereHas('center',function($q){
            $q->where('centers.user_id',Auth()->user()->id);
        })->paginate(8);
        return view('Center.pending',compact('page_title','radiology'));
    }
    public function completed()
    {
        $page_title = __('Completed radiology');
        $radiology  = Radiology::where('reviewed',1)
        ->whereHas('center',function($q){
            $q->where('centers.user_id',Auth()->user()->id);
        })->paginate(8);
        Radiology::where('reviewed',1)
        ->whereHas('center',function($q){
            $q->where('centers.user_id',Auth()->user()->id);
        })->update(['center_seen' => 1]);
        return view('Center.completed',compact('page_title','radiology'));
    }
    public function show($id)
    {
        $page_title = __('Show radiology');
        $radiology  = Radiology::FindOrFail($id);
        /* Very important line for security */
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $centerID   = Center::where('user_id',Auth()->user()->id)->first();
        if($centerID->id!=$radiology->center_id)return redirect()->back();
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */

        return view('Center.show_radiology',compact('page_title','radiology'));
    }
    public function ShowCompleted($id)
    {
        $page_title = __('Show radiology');
        $radiology  = Radiology::FindOrFail($id);
        /* Very important line for security */
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $centerID   = Center::where('user_id',Auth()->user()->id)->first();
        if($centerID->id!=$radiology->center_id)return redirect()->back();
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $feedback   = DoctorFeedback::where('radiology_id',$radiology->id)->first();
        return view('Center.show_completed',compact('page_title','radiology','feedback'));
    }
    public function DownloadFile($id,$radiology_id)//Image ID
    {
        $radiology  = Radiology::FindOrFail($radiology_id);
        /* Very important line for security */
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $centerID   = Center::where('user_id',Auth()->user()->id)->first();
        if($centerID->id!=$radiology->center_id)return redirect()->back();
        /* Mandatory Check */
        /* Mandatory Check */
        /* Mandatory Check */
        $image      = Image::FindOrFail($id);
        $file_path = storage_path('app/public').'/'.$image->base.'/'.$image->name;
        if(file_exists($file_path))return Response::download($file_path);
        else return redirect()->back();

    }
    public function DownloadReport($id,$rad)
    {
        $radiology  = Radiology::findOrFail($rad);
        $feedback   = DoctorFeedback::FindOrFail($id);

        $centerID   = Center::where('user_id',Auth()->user()->id)->first();
        if($radiology->center_id != $centerID->id)return redirect()->back();

        $path       = storage_path('app').DoctorFeedback::Files.$feedback->pdf_report;
        $name       = $feedback->patient->user->getFullNameAttribute().$feedback->pdf_report;
        if (file_exists($path)) return Response::download($path,$name);
        else return redirect()->back();
    }
    public function sendRadiology()
    {
        $doctors    = Doctor::all()->take(5);
        return view('Center.send_radiology',compact('doctors'));
    }
    public function storeRadiology(CenterStoreRadiologyRequest $request)
    {
        /* Make user */
        $user = User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password)
        ]);
        if($request->phone)$user->phone = $request->phone;
        if($request->whats_app)$user->whats_app = $request->whats_app;
        $user->save();
        /* Create Patient  */
        $patient    = Patient::create([
            'user_id'       => $user->id,
            'date_of_birth' => date('Y-m-d',strtotime($request->year.'/'.$request->month.'/'.$request->day)),
        ]);
        /* Attach Role */
        $user->attachRole(User::PatientRole);
        /* Upload Radiologies */
        $center = Center::where('user_id',Auth()->user()->id)->first();
        $Radiology = Radiology::create([
            "desc"          => $request->desc,
            "doctor_id"     => $request->doctor_id,
            "patient_id"    => $patient->id,
            "center_id"      => $center->id
        ]);
        $DirectoryFilePath  = RadiologyFile::patient_radiology_path;
        foreach($request->file('files') as $file){
            $fileName  = $this->uploadFile($file,$DirectoryFilePath);
            $CreateFile= Image::create([
               'name'   => $fileName,
               'base'   => $DirectoryFilePath
            ]);
            RadiologyFile::create([
                'image_id'      => $CreateFile->id,
                'radiology_id'  => $Radiology->id
            ]);
        }

        /* Assume Get Way */
        Payment::create([
             'doctor_id'            => $request->doctor_id,
             'center'               => $center->id,
             'patient_id'           => $patient->id,
             'price'                => $request->fees,
             'statusCode'           => Payment::Success,
        ]);
        session()->flash('created',__("Radiology has been sent successfully to the doctor"));
        return redirect()->route('center.pending.radiology');

    }
    public function uploadFile($file,$base)
    {
        $filenameWithExt        = $file->getClientOriginalName();
        $filename               = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension              = $file->getClientOriginalExtension();
        $fileNameToStore        = $filename.'_'.time().'.'.$extension;
        $path                   = $file->storeAs('public/'.$base,$fileNameToStore);
        return $fileNameToStore;
    }
    public function getFees($id)
    {
        $doctor     = Doctor::findOrFail($id);
        return response()->json([
            'fees'         => $doctor->price,
        ]);
    }
}
