<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Service;
use App\Models\Place;

class VendorController extends Controller
{
    public function index(){
        $users = User::where(["user_type"=>2])->orderBy("id","desc")->get()->toArray();
        return view("admin.pages.vendors.vendors",compact('users'));
    }

    public function create(){
        return view("admin.pages.vendors.create");
    }

    public function store(Request $request){
        $input = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => $request->password
        ];
        
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $input['user_type'] = 2; // vendor

        if(User::create($input)){
            return redirect()->back()->with(['success'=>'Vendor created successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something went wrong with creating vendor']);
        }
    }

    public function edit($id){
        $user = User::where("user_type",2)->findOrFail($id);
        return view("admin.pages.vendors.edit",compact('user'));
    }
    
    public function update(Request $request){
        $user = User::where("user_type",2)->findOrFail($request->id);
        if($user){
            $input['name'] = $request->name;
            $input['email'] = $request->email;
            $input['phone'] = $request->phone;
            $input['address'] = $request->address;

            $rules['name'] = 'required';
            $rules['email'] = 'required|email';
            $rules['phone'] = 'required';
            $rules['address'] = 'required';
            
            if($user->email != $request->email){
                $rules['email'] = 'required|email|unique:users,email';
            }

            if(!empty($request->password)){
                $input['password'] = $request->password;
                $rules['password'] = 'required|min:6';
            }
            
        
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            if(User::where("id",$user->id)->update($input)){
                return redirect()->back()->with(['success'=>'Vendor updated successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong with updating vendor']);
            }
           
        }else{
            return redirect()->back()->with(['error'=>'Vendor not found']);
        }
    }

    public function destroy($id){
        $user = User::where("user_type",2)->findOrFail($id);
        if($user){
            if(User::where("id",$user->id)->delete()){
                return redirect()->back()->with(['success'=>'Vendor Deleted Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong with deleting record']);
            }
            
        }else{
            return redirect()->back()->with(['error'=>'User not found']);
        }
    }

    public function vendor_services($id){
        $services = Service::all()->toArray();
        $vendor = User::where(["user_type"=>2,'id'=>$id])->with("services")->orderBy("id","desc")->first()->toArray();
        return view("admin.pages.vendors.services",compact('vendor','services'));
    }

    public function vendor_services_attach(Request $request, $id){
        $vendor = User::find($id);
        if($vendor){
            $vendor->services()->attach($request->service_id);
            return redirect()->back()->with(["success"=>"Service added successfully"]);
        }else{
            return redirect()->back()->with(["error"=>"Something went wrong"]);
        }
    }

    public function vendor_services_detach($vendor_id, $service_id){
        $vendor = User::find($vendor_id);
        if($vendor){
            $vendor->services()->detach($service_id);
            return redirect()->back()->with(["success"=>"Service deleted successfully"]);
        }else{
            return redirect()->back()->with(["error"=>"Something went wrong"]);
        }
    }

    public function vendor_places($id){
        $places = Place::all()->toArray();
        $vendor = User::where(["user_type"=>2,'id'=>$id])->with("places")->orderBy("id","desc")->first()->toArray();
        return view("admin.pages.vendors.places",compact('vendor','places'));
    }

    public function vendor_places_attach(Request $request, $id){
        $vendor = User::find($id);
        if($vendor){
            $vendor->places()->attach($request->place_id);
            return redirect()->back()->with(["success"=>"Place added successfully"]);
        }else{
            return redirect()->back()->with(["error"=>"Something went wrong"]);
        }
    }

    public function vendor_places_detach($vendor_id, $place_id){
        $vendor = User::find($vendor_id);
        if($vendor){
            $vendor->places()->detach($place_id);
            return redirect()->back()->with(["success"=>"Place deleted successfully"]);
        }else{
            return redirect()->back()->with(["error"=>"Something went wrong"]);
        }
    }
}
