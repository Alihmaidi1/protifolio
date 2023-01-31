<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\contactus\delete;
use App\Http\Requests\contactus\store;
use Illuminate\Http\Request;
use \App\Models\contantus as Modelscontact;
use Illuminate\Database\Eloquent\Model;

class contactus extends Controller
{

    public function createcontactus(store $request){

        try{

            $contact = Modelscontact::create([

                "name"=>$request->name,
                "email"=>$request->email,
                "subject"=>$request->subject,
                "message"=>$request->message
                
            ]);


            return response()->json(["message"=>"the contact was created successfully","data"=>$contact]);
            
        }catch(\Exception $ex){



            return response()->json(["message" => "we have error"], 500);


        }



    }


    public function deletecontantus(delete $request){

        try{

            $contant = Modelscontact::find($request->id);
            $contant1 = $contant;
            $contant->delete();
            return response()->json(["message"=>"the contact was deleted successfully","data"=>$contant1]);


        }catch(\Exception $ex){

            return response()->json(["message"=>"we have error"],500);


        }



    }


    public function getallcontant(Request $request){
        try{


            return response()->json(["message"=>"the contant data was fetched successfully","data"=>Modelscontact::all()]);

            
        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],500);

        }


    }

}
