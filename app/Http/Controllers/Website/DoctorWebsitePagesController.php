<?php

namespace App\Http\Controllers\Website;
use App\Models\City;
use App\Models\Field;
use App\Models\Doctor;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\DoctorSpecialize;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentFormRequest;

class DoctorWebsitePagesController extends Controller
{
    public function home()
    {
        $specialties    = Field::all();
        $governorates   = Governorate::all();
        return view('website.searchDoctors',compact('specialties','governorates'));
    }
    public function showCities($id)
    {
        $cities = City::where('governorate_id', $id)->get();
        if($cities->count() > 0 ){
            return response()->json([
                'cities' => $cities
            ]);
        }
        return response()->json([
            'cities' => null
        ]);
    }
    public function search(Request $request)
    {

        $specialties    = Field::all();
        $governorates   = Governorate::all();
        $Doctors        = Doctor::where('active',1);

        if(isset($request->name)){
            $Doctors->whereHas('user',function($q) use($request){
                $q->where('users.first_name','LIKE','%'.$request->name.'%')
                  ->where('users.last_name','LIKE','%'.$request->name.'%');
            });
        }
        if(isset($request->specialty_id))$Doctors->where('field_id',$request->specialty_id);
        if(isset($request->governorate_id))$Doctors->where('governorate_id',$request->governorate_id);
        if(isset($request->city_id))$Doctors->where('city_id',$request->city_id);

        $Doctors = $Doctors->paginate(9);
        $Doctors->appends(
            [
                'specialty_id'      => $request->field_id,
                'governorate_id'    => $request->governorate_id,
                'city_id'           => $request->city_id,
                'name'              => $request->name
            ]
        );
        return view('website.doctors',compact('specialties','governorates','Doctors'));
    }
    public function show($field,$id,$name)
    {
        $doctor    = Doctor::where('active',1)
        ->where('id',$id)->first();
        if(!$doctor)return redirect()->route('Website.doctors.search');
        $doctor_specializes  = DoctorSpecialize::where('doctor_id',$id)->get();
        $reviews=$doctor->reviews;

        return view('website.doctor_profile',compact('doctor','doctor_specializes','reviews'));
    }
    public function validate_from(Doctor $doctor,AppointmentFormRequest $request){
        
        session(['AppointmentFormRequest' => $request->all()]);
        return view('website.doctor_profile',compact('doctor','doctor_specializes','reviews'));
    }
}
