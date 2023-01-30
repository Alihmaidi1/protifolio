<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\project\create;
use App\Http\Requests\project\createimage;
use App\Http\Requests\project\delete;
use App\Http\Requests\project\update;
use App\Models\project as ModelsProject;
use App\Models\temp;
use Illuminate\Http\Request;

class project extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function createimage(createimage $request){

        try{

            $name=saveimage($request->file("image"));
            $image=temp::create([

                "url"=>$name

            ]);

            return response()->json(["message"=>"the image was created successfully","data"=>$image]);            



            
        }catch(\Exception $ex){


            return response()->json(["message" => $ex->getMessage()], 500);

        }


    }


    public function getallproject(Request $request)
    {

        try{


            return ModelsProject::all();

        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],500);


        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createproject(create $request)
    {
    
        try{

            $name = temp::find($request->photo_id);
            movefile("temp/".$name->getRawOriginal("url"),"project/".$name->getRawOriginal("url"));
            $name->delete();
            $project = ModelsProject::create([
                "name"=>$request->name,
                "url"=>$request->url,
                "image"=>"project/".$name->getRawOriginal("url")
            ]);

            return response()->json(["message" => "the project was create successfully","data"=>$project]);

        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],500);

        }
    
    
    
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateproject(update $request)
    {

        try{


            $project = ModelsProject::find($request->id);
            if($request->photo_id!=null){
    
                $name = temp::find($request->photo_id);
                movefile("temp/".$name->getRawOriginal("url"),"project/".$name->getRawOriginal("url"));
                $project->image = "project/" . $name->getRawOriginal("url");
                $name->delete();
    
            }else{
    
    
                $project->image = $project->getRawOriginal("image");
    
            }
            $project->name = $request->name;
            $project->url = $request->url;
            $project->save();
            return response()->json(["message"=>"the project was updated successfully","data"=>$project]);
    
    

        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],500);

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteproject(delete $request)
    {
        try{
            $project = ModelsProject::find($request->id);
            $project1 = $project;
            unlink(public_path($project->getRawOriginal("image")));
            $project->delete();
            return response()->json(["message"=>"the project was deleted successfully","data"=>$project1]);

        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);
        }
    }
}
