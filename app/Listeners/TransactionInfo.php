<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TransactionInfo
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
        $postData = array(
            'transactionId' =>$event['transactionId']
        );

        $secureHash= env("secureHash");
        $postData['hashSecret'] = generateHash($secureHash,$postData);

        $postData['appId']=env("appId");
        $postData['password']=env("payment_password");

        $url ='https://api.vapulus.com:1338/app/transactionInfo';

        $output=HTTPPost($url,$postData);

        $result=json_decode($output);

        if($result->{'statusCode'} != 200){
            return false;
        }else {
            return $result->{'data'};
        }

    }
}
