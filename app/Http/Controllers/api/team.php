<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\team\delete;
use App\Http\Requests\team\store;
use App\Http\Requests\team\update;
use App\Models\team as ModelsTeam;
use App\Models\temp;
use Illuminate\Http\Request;

class team extends Controller
{
    
    public function createteam(store $request){

        try{
            
                $name = temp::find($request->image_id);
                movefile("temp/".$name->getRawOriginal("url"),"team/".$name->getRawOriginal("url"));
                $name->delete();
                $team = ModelsTeam::create([
                    "name"=>$request->name,
                    "age"=>$request->age,
                    "gender"=>$request->gender,
                    "from"=>$request->from,
                    "image"=>"team/".$name->getRawOriginal("url")
                ]);
                return response()->json(["message" => "the Team was create successfully","data"=>$team]);

        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }

    public function updateteam(update $request){

        try{
           


                $team = ModelsTeam::find($request->id);
                if($request->image_id!=null){
        
                    $name = temp::find($request->image_id);
                    movefile("temp/".$name->getRawOriginal("url"),"team/".$name->getRawOriginal("url"));
                    $team->image = "team/" . $name->getRawOriginal("url");
                    $name->delete();
        
                }else{
        
                    $team->image = $team->getRawOriginal("image");
        
                }

                $team->name = $request->name;
                $team->age = $request->age;
                $team->gender = $request->gender;
                $team->from = $request->from;

                $team->save();
                return response()->json(["message"=>"the project was updated successfully","data"=>$team]);
            
        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);


        }


    }


    public function getallteam(Request $request){
        try{


            return response()->json(["message" => "the data was fetched successfully", "data" => ModelsTeam::all()]);


        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],500);

        }

    }


    public function deleteteam(delete $request){

        try{

            $team = ModelsTeam::find($request->id);
            $team1 = $team;
            unlink(public_path($team->getRawOriginal("image")));
            $team->delete();
            return response()->json(["message"=>"the project was deleted successfully","data"=>$team1]);

        }catch(\Exception $ex){

            return response()->json(["message"=>"we have error"],500);

        }


    }


}
