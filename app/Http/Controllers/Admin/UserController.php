<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::where(["user_type"=>1])->orderBy("id","desc")->get()->toArray();
        return view("admin.pages.users.users",compact('users'));
    }

    public function create(){
        return view("admin.pages.users.create");
    }

    public function store(Request $request){
        $input = [
            'name' => $request->name,
            'bride_name' => $request->bride_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'wedding_date' => $request->wedding_date,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        
        $rules = [
            'name' => 'required',
            'bride_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'wedding_date' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $input['user_type'] = 1; // user

        if(User::create($input)){
            return redirect()->back()->with(['success'=>'User created successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something went wrong with creating user']);
        }
    }

    public function edit($id){
        $user = User::where("user_type",1)->findOrFail($id);
        return view("admin.pages.users.edit",compact('user'));
    }
    
    public function update(Request $request){
        $user = User::where("user_type",1)->findOrFail($request->id);
        if($user){
            $input['name'] = $request->name;
            $input['email'] = $request->email;
            $input['bride_name'] = $request->bride_name;
            $input['phone'] = $request->phone;
            $input['address'] = $request->address;
            $input['wedding_date'] = $request->wedding_date;

            $rules['name'] = 'required';
            $rules['email'] = 'required|email';
            $rules['bride_name'] = 'required';
            $rules['phone'] = 'required';
            $rules['address'] = 'required';
            $rules['wedding_date'] = 'required';
            
            if($user->email != $request->email){
                $rules['email'] = 'required|email|unique:users,email';
            }

            if(!empty($request->password)){
                $input['password'] = Hash::make($request->password);
                $rules['password'] = 'required|min:6';
            }
            
        
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            if(User::where("id",$user->id)->update($input)){
                return redirect()->back()->with(['success'=>'User updated successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong with updating user']);
            }
           
        }else{
            return redirect()->back()->with(['error'=>'User not found']);
        }
    }

    public function destroy($id){
        $user = User::where("user_type",1)->findOrFail($id);
        if($user){
            if(User::where("id",$user->id)->delete()){
                return redirect()->back()->with(['success'=>'User Deleted Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong with deleting record']);
            }
            
        }else{
            return redirect()->back()->with(['error'=>'User not found']);
        }
    }
}
