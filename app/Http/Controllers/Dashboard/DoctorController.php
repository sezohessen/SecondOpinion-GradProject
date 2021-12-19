<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\DoctorDatatable;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoctorDatatable $doctor)
    {
        $page_title = __('Doctors');
        $page_description = __('View Doctors');
        return  $doctor->render("dashboard.Doctor.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title         = __("Add Doctor");
        $page_description   = __("Add new Doctor");
        return view('dashboard.Doctor.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userRules = User::rules($request);
        $doctorRules = Doctor::rules($request);
        $request->validate(array_merge($doctorRules,$userRules));
        $userCredentials = User::credentials($request);
        $user = User::create($userCredentials);
        $doctorCredentials = Doctor::credentials($request,$user->id);
        Doctor::create($doctorCredentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.doctor.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
