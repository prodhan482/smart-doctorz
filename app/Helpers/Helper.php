<?php

namespace App\Helpers;



use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Helper
{ 
    public static function sendSMS($contracts, $message)
    {
        $url = "https://msg.elitbuzz-bd.com/smsapi";
        $data = [
            "api_key" => "C2008095618587fd616629.30891805",
            "type" => "text",
            "contacts" => $contracts,
            "senderid" => "8809612436577",
            "msg" => $message,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    const API_TOKEN = "hf5ldhb6-lqylljfg-gopriech-r1ooxglz-su0oqrxn"; //put ssl provided api_token here
    const SID = "IMPULSENONOTP"; // put ssl provided sid here
    const DOMAIN = "https://smsplus.sslwireless.com"; //api domain
    const ERROR_CODE = ['200' => 'SMS has been sent successfully', '4025' => 'Invalid Phone Number', '4003' => 'IP Blacklisted'];
    const STATUS_TYPE = ['SUCCESS', 'FAILED'];


}