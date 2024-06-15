<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Service;
use App\Models\Product;

class ServiceController extends Controller
{
    public function index(){
        $list = Service::orderBy("id","desc")->get()->toArray();
        return view("admin.pages.services.services",compact('list'));
    }

    public function create(){
        return view("admin.pages.services.create");
    }

    public function store(Request $request){
        $input = [
            'name' => $request->name,
            'image' => $request->image,
            'status' => $request->status
        ];
        
        $rules = [
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'status' => 'required|numeric',
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);

            $input['image'] = $imageName;
        }

        if(Service::create($input)){
            return redirect()->back()->with(['success'=>'Service created successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something went wrong with creating service']);
        }
    }

    public function edit($id){
        $item = Service::findOrFail($id);
        return view("admin.pages.services.edit",compact('item'));
    }
    
    public function update(Request $request){
        $item = Service::findOrFail($request->id);
        if($item){
            $input['name'] = $request->name;
            $input['status'] = $request->status;

            $rules['name'] = 'required';
            $rules['status'] = 'required|numeric';

            if ($request->file('image')) {
                $input['image'] = $request->image;
                $rules['image'] = 'mimes:jpeg,jpg,png,gif|required|max:10000';
            }
            
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            if ($request->file('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);
    
                $input['image'] = $imageName;
            }

            if(Service::where("id",$item->id)->update($input)){
                return redirect()->back()->with(['success'=>'Service updated successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong with updating service']);
            }
           
        }else{
            return redirect()->back()->with(['error'=>'Data not found']);
        }
    }

    public function destroy($id){
        $item = Service::findOrFail($id);
        if($item){
            if(Service::where("id",$item->id)->delete()){
                return redirect()->back()->with(['success'=>'Service Deleted Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong with deleting record']);
            }
            
        }else{
            return redirect()->back()->with(['error'=>'Data not found']);
        }
    }

    public function service_products($id){
        $products = Product::all()->toArray();
        $service = Service::where("id",$id)->with("products")->orderBy("id","desc")->first()->toArray();
        return view("admin.pages.services.products",compact('service','products'));
    }

    public function service_products_attach(Request $request,$id){
        $service = Service::find($id);
        if($service){
            $service->products()->attach($request->product_id);
            return redirect()->back()->with(["success"=>"Product added successfully"]);
        }else{
            return redirect()->back()->with(["error"=>"Something went wrong"]);
        }
    }

    public function service_products_detach($service_id,$product_id){
        $service = Service::find($service_id);
        if($service){
            $service->products()->detach($product_id);
            return redirect()->back()->with(["success"=>"Product deteled successfully"]);
        }else{
            return redirect()->back()->with(["error"=>"Something went wrong"]);
        }
    }
}
