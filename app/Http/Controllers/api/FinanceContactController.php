<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Country;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator as Validator;
use App\Classes\Responseobject;

class FinanceContactController extends Controller
{
    use GeneralTrait;
    public function create(Request $request)
    {
        $this->lang($request->lang);
        $data       = $request->all();
        $response   = new Responseobject();
        $array_data = (array)$data;
        $validator  = Validator::make($array_data, [
            'message'           => 'required|min:3|max:1000',
            'name'              => 'required',
            'email'             => 'required|email',
            'phone'             => 'string',
            'interest_country'  => 'nullable|integer', //Will be updated
        ]);

        if (!$validator->fails()) {
            if ($request->interest_country) {
                $country    = Country::find($request->interest_country);
                if (!$country) {
                    return $this->errorMessage(__('Not found Country id'));
                }
            }
            $ContactUs = ContactUs::create([
                'message'       => $request->message,
                'email'         => $request->email,
                'phone'         => $request->phone,
            ]);
            if ($country) {
                $ContactUs->country_phone = $country->country_phone;
                $ContactUs->save();
            }
            return $this->returnSuccess(__("We will contact you soon"));
        } else {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
    }
}
