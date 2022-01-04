<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\DoctorDatatable;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOTNET;
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
        $userRules = User::rules();
        $doctorRules = Doctor::rules();
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
    public function edit(Doctor $doctor)
    {
        $page_title         = __("Edit Doctor");
        $page_description   = __("Edit");
        return view('dashboard.Doctor.edit', compact('page_title', 'page_description','doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $userRules = User::rules($doctor->user->id);
        $doctorRules = Doctor::rules($doctor->id);
        $request->validate(array_merge($doctorRules,$userRules));
        $userCredentials = User::credentials($request);
        $doctor->user->update($userCredentials);
        $doctorCredentials = Doctor::credentials($request,$doctor->user->id,$doctor->avatar->id);
        $doctor->update($doctorCredentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return  redirect()->route("dashboard.doctor.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        delete_file($doctor->avatar->id);
        $doctor->user()->delete();
        $doctor->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.doctor.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$doctor = Doctor::find($id);
                delete_file($doctor->avatar->id);
                $doctor->user()->delete();
                $doctor->delete();
			}
		} else {
			$doctor = Doctor::find(request('item'));
            delete_file($doctor->avatar->id);
            $doctor->user()->delete();
            $doctor->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.doctor.index");
    }
}
