<?php

namespace App\Handler;

class CurlApi
{
    public function api()
    {
        $url = "https://accounts.spotify.com/api/token";
        $clientID  = "806294fa00c04ae2900bd53d72410ba1";
        $clientSecret = "03968ecfd3cb4afb8ea8b49c3036fe90";
        $header = [
            "Content-Type: application/x-www-form-urlencoded"
        ];
        $field = http_build_query(array(
            "grant_type"=>"client_credentials",
            "client_id"=>$clientID,
            "client_secret"=>$clientSecret
        ));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $field);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }
}
