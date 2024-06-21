<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index(){
        $id  = Auth::user()->id;
        $user = User::where("id",$id)->first()->toArray();

        return response()->json([
            "success"=>true,
            "message"=>"Profile Details",
            "user"=>$user
        ], 200);

    }

    public function update(Request $request){
        $rules = [
            'name' => 'required',
            'bride_name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'wedding_date' => 'required|date',
            'email' => 'required|unique:users,email',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "message"=>"Invalid Request - Validation erros",
                "errors"=>$validator->getMessageBag()->toArray()
            ], 202);
        }else{

            $user_id = Auth::user()->id;
            $input = $request->all();

            if(User::where("id",$user_id)->update($input)){
                $user = User::where("id",$user_id)->first()->toArray();
                return response()->json([
                    "success"=>true,
                    "message"=>"Profile Updated",
                    "user"=>$user
                ], 200);
            }else{
                return response()->json([
                    "success"=>false,
                    "message"=>"Something went wrong with updating profile",
                    "user"=>null
                ], 201);
        }   }   
    }

    public function password_update(Request $request){
        $rules = [
            'new_password' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "message"=>"Invalid Request - Validation erros",
                "errors"=>$validator->getMessageBag()->toArray()
            ], 202);
        }else{


            $user_id = Auth::user()->id;

            if(User::where("id",$user_id)->update(['password'=>Hash::make($request->new_password)])){
                return response()->json([
                    "success"=>true,
                    "message"=>"Password Updated",
                ], 200);
            }else{
                return response()->json([
                    "success"=>false,
                    "message"=>"Something went wrong with updating passwords",
                ], 201);
            }
        }   
    }
}
