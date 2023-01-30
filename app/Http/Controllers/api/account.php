<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\account\delete;
use App\Http\Requests\account\login;
use App\Http\Requests\account\store as storeuser;
use App\Http\Requests\account\update;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class account extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(login $request)
    {
     
        try{

            $token=tokenInfo($request->email,$request->password,"users");
            if($token->status()==200){
            $admin=User::where("email",$request->email)->first();
            $admin->token_info=$token->json();
            $admin->message=trans("admin.your are login successfully");
            return response()->json(["data"=>$admin,"message"=>"you are login successfully"]);

            }else{
                return response()->json(["message"=>$token->json()],405);
            }

        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],405);


        }

    }

    public function logout(Request $request){

        try{

        $user=auth("api")->user();
        $user->token()->revoke();
        return response()->json(["message" => "you are logout successfully","data"=>$user]);

            



        }catch(\Exception $ex){


            return response()->json(["message" => "we have error"], 405);

        }



    }


    public function  profile(Request $request){

        try{

            $user = auth("api")->user();

            return response()->json(["message"=>"the data was fetched successfully","data"=>$user]);

        }catch(\Exception $ex){

            return response()->json(["message"=>"we have error"],405);

        }


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeuser $request)
    {

        try{

            $user = User::create([

                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Hash::make($request->password),
                "permission"=>json_encode($request->permission)
    
    
            ]);

            return response()->json(["data"=>$user,"message"=>"the admin was created successfully"]);

        }catch(\Exception $ex){

            return response()->json(["message" => $ex->getMessage()],405);



        }
        

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
    public function update(update $request)
    {
        
        try{

            $user = User::find($request->id);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->permission = json_encode($request->permission);
            $user->save();
            return response()->json(["message"=>"the user was updated successfully","data"=>$user]);



        }catch(\Exception $ex){

            return response()->json(["message" => "we have error"],405);

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(delete $request)
    {

        try{

            $user = User::find($request->id);
            $user1 = $user;
            $user->delete();

            return response()->json(["message" => "the user was deleted successfully","data"=>$user1]);
            
        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],405);

        }


    }


    public function getalluser(Request $request){

        try{

            return User::all();

            
        }catch(\Exception $ex){


            return response()->json(["message"=>"we have error"],405);

        }



    }

    
}
