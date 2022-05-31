<?php

namespace App\Http\Controllers\Website;

use App\Events\PaymentEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientOpinionRequest;
use App\Listeners\SessionPay;
use App\Listeners\TransactionInfo;
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
    public function store(StorePatientOpinionRequest $request,Doctor $doctor,Patient $patient)
    {

        if(!session("files")){

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
            session(['files'=> true]);
        }

        $request->validate(["SessionID"=> "required"]);

        $payment_processing=(new SessionPay)->handle([
            "doctor"=> $doctor,
            "patient"=> $patient,
            "sessionId"=> $request->SessionID,
        ]);
        if($payment_processing) {
            return  view("website.payment_processing",compact("payment_processing"));
        }else {
            session()->flash('failed',__("Processing doesn't complete successfully, please try later"));
            return redirect()->back();
        }

        // /* Assume that patinet pass from payment getway */
        // Payment::create([
        //     'doctor_id'         => $doctor->id,
        //     'patient_id'        => $patient->id,
        //     'price'             => $doctor->price,
        //     'status'            => Payment::Success
        // ]);
        /* Assume that patinet pass from payment getway */

        // session()->flash('success',__("Request has been sent successfully, Doctor will review the radiology and send the report."));
        // return redirect()->route('Website.doctor.profile',[
        //     'field' => LangDetail($doctor->field->name,$doctor->field->name_ar),
        //     'id'    => $doctor->id,
        //     'name'  => $doctor->user->FullName
        // ]);
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
    public function payment_status(Request $request,Patient $patient,Doctor $doctor){

        $data=(new TransactionInfo)->handle([
            "transactionId"=> $request->transactionId
        ]);
        if($data){
            Payment::create([
                "doctor_id"=>$doctor->id,
                "patient_id"=>$patient->id,
                'center_id' => null,
                'price'     => $doctor->id,
                'statusCode'=> Payment::statusCode()[(int)$data->status],
                'transactionId'=> $request->transactionId,
            ]);
            session()->flash('success',__("Request has been sent successfully, Doctor will review the radiology and send the report."));
        }else {
            session()->flash('failed',__("Processing doesn't complete successfully, please try later"));
        }

        return redirect()->route('Website.doctor.profile',[
            'field' => LangDetail($doctor->field->name,$doctor->field->name_ar),
            'id'    => $doctor->id,
            'name'  => $doctor->user->FullName
        ]);
    }
}
