<?php

namespace App\Http\Controllers\Website;


use App\Models\Part;

use App\Models\CarModel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CarCapacity;
use App\Models\CarClassification;
use App\Models\CarMaker;
use App\Models\CarYear;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Review;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $Request)
    {

        return view('website.index');

    }
    public function getPosition(Request $request)
    {
        return [$request->latitude,$request->longitude];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = __('Part');

        $part         = Part::where('id', $id)
        ->where('active',1)
        ->first();

        // Show reviews
        $reviews = Review::where('part_id',$id)->get();
        if($part){
        $partReview = Review::where('part_id',$id)
        ->get()
        ->first();
        $hasReview = Review::NotLogin;
        if(Auth::check())$hasReview    = Review::where('user_id', Auth()->user()->id)->where('part_id',$id)->first() ? Review::HasReview:Review::HasNotReview;

        $carModelID    = $part->car->model->id;
        $RelatedModelParts = Part::whereHas('car', function($q) use($carModelID) {
            $q->where('cars.carModel_id',$carModelID);
        })
        ->where('id','!=',$id)
        ->where('active',1)
        ->limit(12)
        ->get();
        $partId = 'part_'.$part->id;
        if(!Session::has($partId)){
            $part->increment('views');
            Session::put($partId, 1);
        }
        $reviewCount    = Review::where('part_id',$id)
        ->get()
        ->count();
        return view('website.part',compact('part','hasReview','RelatedModelParts','reviews','partReview','page_title','reviewCount'));
        }
        else return redirect()->route('Website.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function available_cities($id)
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
    public function available_model($id){
        $models = CarModel::where('CarMaker_id', $id)->get();
        if($models->count() > 0 ){
            return response()->json([
                'models' => $models
            ]);
        }
        return response()->json([
                'models' => null
        ]);
    }
    public function available_year($id){
        $years = CarYear::where('CarModel_id', $id)->get();
        if($years->count() > 0 ){
            return response()->json([
                'years' => $years
            ]);
        }
        return response()->json([
                'years' => null
        ]);
    }
}
