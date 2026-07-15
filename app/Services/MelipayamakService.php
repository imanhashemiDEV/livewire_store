<?php

namespace App\Services;
use Melipayamak;
class MelipayamakService
{
    public static function sendSMS($mobile,$message)
    {
        try{

            $sms = Melipayamak::sms();
            $to = $mobile;
            $from = '50004001014556';
            $text = $message;
            $response = $sms->send($to,$from,$text);
            $json = json_decode($response);
            //echo $json->Value; //RecId or Error Number
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    }



