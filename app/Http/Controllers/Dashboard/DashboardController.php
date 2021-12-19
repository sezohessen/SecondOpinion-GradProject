<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\ContactUs;
use App\Models\Doctor;
use App\Models\Part;
use App\Models\Patient;
use App\Models\Specialty;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $page_title         = __('Dashboard');
        $page_description   = __('Information management');
        $users              = User::all();
        $contacts           = ContactUs::all();
        $patients=Patient::all();
        $specialties=Specialty::all();
        $centers=Center::all();
        $doctors=Doctor::all();
        return view('dashboard.index', compact('page_title', 'page_description','users',
        'doctors','specialties','patients','centers'
        ,'contacts'));
    }
}
