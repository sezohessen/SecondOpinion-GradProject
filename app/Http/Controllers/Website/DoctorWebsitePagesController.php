<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Field;
use App\Models\Governorate;
use Illuminate\Http\Request;

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
}
