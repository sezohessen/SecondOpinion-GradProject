<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SpecialtyDatatable;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SpecialtyDatatable $specialty)
    {
        $page_title         = __('Specialties');
        $page_description   = __('View Specialties');
        return  $specialty->render("dashboard.Specialty.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title         = __("Add specialty");
        $page_description   = __("Add new specialty");
        return view('dashboard.Specialty.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Specialty::rules($request);
        $request->validate($rules);
        $credentials = Specialty::credentials($request);
        $Specialty = Specialty::create($credentials);
        session()->flash('created',__("Changes has been Created Successfully"));
        return redirect()->route("dashboard.specialty.index");
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
    public function edit(Specialty $specialty)
    {
        $page_title         = __("Edit specialty");
        $page_description   = __("Edit");
        return view('dashboard.Governorate.edit', compact('page_title', 'page_description','specialty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
        $rules =$specialty->rules($request);
        $request->validate($rules);
        $credentials = $specialty->credentials($request);
        $specialty->update($credentials);
        session()->flash('updated',__("Changes has been Updated Successfully"));
        return  redirect()->route("dashboard.specialty.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.specialty.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$specialty = Specialty::find($id);
				$specialty->delete();
			}
		} else {
			$specialty = Specialty::find(request('item'));
			$specialty->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.specialty.index");
    }
}
