<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use File;

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


    function saveimage($image){

        $name = time().rand(1000000, 9999999) . "." . $image->getClientOriginalExtension();
        Storage::disk("public")->putFileAs("temp",$image,$name);
        return $name;


    }


    function movefile($from,$to){


    File::move(public_path($from), public_path($to));

        

    }

