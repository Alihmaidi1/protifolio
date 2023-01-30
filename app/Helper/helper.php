<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

function tokenInfo($email,$password,$provider){

    
    $client= DB::table('oauth_clients')->where("provider",$provider)->first();
    return Http::asForm()->withHeaders([

        "apipassword"=>env("api_password")

    ])->post(request()->root()."/oauth/token",[
            'grant_type' => 'password',
            'client_id' =>$client->id,
            'client_secret' => $client->secret ,
            'username' => $email ,
            'password' => $password
    ]);


}

