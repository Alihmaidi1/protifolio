<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\experience\delete;
use App\Http\Requests\experience\store;
use App\Http\Requests\experience\update;
use App\Models\experinece;
use Illuminate\Http\Request;

class experience extends Controller
{


    public function createexperience(store $request){

        try{

            $experience = experinece::create([

                "name"=>$request->name,
                "precent"=>$request->precent,
                "team_id"=>$request->team_id

            ]);

            return response()->json(["message" => "the experience was added to person successfully","data"=>$experience]);

        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }



    public function updateexperience(update $request){

        try{

            $experience = experinece::find($request->id);
            $experience->team_id = $request->team_id;
            $experience->name = $request->name;
            $experience->precent = $request->precent;
            $experience->save();

            return response()->json(["message"=>"the experience was updated successfully","data"=>$experience]);



        }catch(\Exception $ex){

            return response()->json(["message"=>"we have error"],500);

        }



    }


    public function getallexperience(Request $request){

        try{

            return response()->json(["message"=>"the data was fetched successfully","data"=>experinece::all()]);



            
        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],500);
        }


    }


    public function deleteexperience(delete $request){
        try{

            $experience = experinece::find($request->id);
            $experience1 = $experience;
            $experience->delete();
            return response()->json(["message"=>"the experience was deleted successfully","data"=>$experience1]);


        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],500);

        }


    }

}
