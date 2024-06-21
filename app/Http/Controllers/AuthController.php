<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "message"=>"Invalid Request - Validation erros",
                "errors"=>$validator->getMessageBag()->toArray()
            ], 202);
        }else{

            $credentials = $request->only('email', 'password');
            

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'success'=>true,
                    'message'=>'User Logged in',
                    'token' => $token
                ], 200);
            }

      

            return response()->json([
                'success'=>false,
                'message' => 'Invalid credentials',
                'token' => null
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success'=>true,
            'message' => 'Logged out successfully'
        ], 200);
    }
}
