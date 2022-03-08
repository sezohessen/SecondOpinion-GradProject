<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorWebsitePagesController extends Controller
{
    public function home()
    {
        return view('website.searchDoctors');
    }
}
