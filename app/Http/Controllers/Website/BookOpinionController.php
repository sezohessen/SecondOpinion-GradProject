<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientOpinionRequest;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Radiology;
use App\Models\RadiologyFile;
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
    public function store(StorePatientOpinionRequest $request,$id)
    {
        $doctor     = Doctor::findOrFail($id);
        try {
            $patient    = Patient::where('user_id',auth()->user()->id)->first();
        } catch (\Throwable $th) {
            echo 'Caught exception: ',  $th->getMessage(), "\n";
        }
        $Radiology = Radiology::create([
            "desc"          => $request->desc,
            "doctor_id"     => $doctor->id,
            "patient_id"    => $patient->id,
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

        /* Assume that patinet pass from payment getway */
        Payment::create([
            'doctor_id'         => $doctor->id,
            'patient_id'        => $patient->id,
            'price'             => $request->fees,
            'status'            => Payment::Success
        ]);
        /* Assume that patinet pass from payment getway */

        session()->flash('success',__("Request has been sent successfully, Doctor will review the radiology and send the report."));
        return redirect()->route('Website.doctor.profile',[
            'field' => LangDetail($doctor->field->name,$doctor->field->name_ar),
            'id'    => $doctor->id,
            'name'  => $doctor->user->FullName
        ]);
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
}
