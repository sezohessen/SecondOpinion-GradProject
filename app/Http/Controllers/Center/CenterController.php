<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Doctor;
use App\Models\DoctorFeedback;
use App\Models\Image;
use App\Models\Radiology;
use Illuminate\Http\Request;
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
        $filepath   = public_path().$image->base.$image->name;
        if(file_exists($filepath))return Response::download($filepath);
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
        return view('website.center_send_radiology',compact('doctors'));
    }
}
