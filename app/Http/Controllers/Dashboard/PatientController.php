<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\DataTables\PatientDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PatientDatatable $doctor)
    {
        $page_title = __('Patients');
        $page_description = __('View Patients');
        return  $doctor->render("dashboard.Patient.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title         = __("Add Patient");
        $page_description   = __("Add new Patient");
        return view('dashboard.Patient.add', compact('page_title', 'page_description'));
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
        $patientRules = Patient::rules();
        $request->validate(array_merge($patientRules,$userRules));
        $userCredentials = User::credentials($request);
        $user = User::create($userCredentials);
        $patientCredentials = Patient::credentials($request,$user->id);
        Patient::create($patientCredentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.patient.index");
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
    public function edit(Patient $patient)
    {
        $page_title         = __("Edit Patient");
        $page_description   = __("Edit");
        return view('dashboard.Patient.edit', compact('page_title', 'page_description','patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {

        $userRules = User::rules($patient->user->id);
        $patientRules = Patient::rules();
        $request->validate(array_merge($patientRules,$userRules));
        $userCredentials = User::credentials($request);
        $patient->user->update($userCredentials);
        $patientCredentials = Patient::credentials($request,$patient->user->id);
        $patient->update($patientCredentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return  redirect()->route("dashboard.patient.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->user()->delete();
        $patient->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.patient.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$patient = Patient::find($id);
                $patient->user()->delete();
                $patient->delete();
			}
		} else {
			$patient = Patient::find(request('item'));
            $patient->user()->delete();
            $patient->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.patient.index");
    }
}
