<?php

namespace App\Http\Requests\account;

use App\Rules\checkPermission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            "id"=>"required|exists:users,id",
            "email"=>"required|unique:users,email,".request()->id,
            "name"=>"required",
            "permission"=>["required",new checkPermission]
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        
        throw new HttpResponseException(

            response()->json(["data"=>[],"message"=>$validator->errors()->first()],401)

        );
        
        
    }

}
