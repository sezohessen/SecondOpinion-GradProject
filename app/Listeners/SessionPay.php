<?php

namespace App\Listeners;

use App\Models\Payment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SessionPay
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $doctor=$event["doctor"];
        $patient=$event["patient"];

        $postData = array(
            'sessionId' =>$event["sessionId"],
            'mobileNumber' => $patient->user->phone,
            'email' =>$patient->user->email,
            'amount' =>$doctor->price,
            'firstName' =>$patient->user->first_name,
            'lastName' => $patient->user->last_name,
            'onAccept' => route('Website.payment_status',[
                'doctor'    => $doctor->id,
                'patient'    => $doctor->id,
            ]),
            'onFail' => 'http://example.com/fail',
        );

        // 'onAccept' => route('Website.patient.show.radiology',[
        //     'id'    => $patient->id,
        // ]),
        $secureHash= env("secureHash");
        $postData['hashSecret'] = generateHash($secureHash,$postData);

        $postData['appId']=env("appId");
        $postData['password']=env("payment_password");

        $url ='https://api.vapulus.com:1338/app/session/pay';

        $output=HTTPPost($url,$postData);

        $result=json_decode($output);

        if($result->{'statusCode'} != 200){
            return false;
        }else {
            return $result->{'data'}->{'htmlBodyContent'};
        }
    }

}
