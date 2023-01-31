<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\service\delete;
use App\Http\Requests\service\store;
use App\Http\Requests\service\update;
use App\Models\service as ModelsService;
use Illuminate\Http\Request;

class service extends Controller
{


    public function createservice(store $request){

        try{

            $service = ModelsService::create([

                "name"=>$request->name,
                "description"=>$request->description
            ]);

            return response()->json(["message"=>"the service was created successfully","data"=>$service]);


        }catch(\Exception $ex){

            return response()->json(["message"=>"we have error"],500);


        }




    }


    public function updateservice(update $request){

        try{


            $service = ModelsService::find($request->id);
            $service->name = $request->name;
            $service->description = $request->description;
            $service->save();

            return response()->json(["message"=>"the service was updated successfully","data"=>$service]);



        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"]);

        }





    }


    public function getallservice(Request $request){


        try{


            return response()->json(["message"=>"the service was fetched succcessfully","data"=>ModelsService::all()]);

        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],500);

        }

    }


    public function deleteservice(delete $request){


        try{

            $service = ModelsService::find($request->id);
            $service1 = $service;
            $service->delete();
            return response()->json(["message"=>"the service was deleted successfully","data"=>$service1]);


        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],500);

        }

    }


}
