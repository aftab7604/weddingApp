<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;


class ProductController extends Controller
{
    public function index(){
        $list = Product::orderBy("id","desc")->get()->toArray();
        return view("admin.pages.products.products",compact('list'));
    }

    public function create(){
        return view("admin.pages.products.create");
    }

    public function store(Request $request){
        $input = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            'status' => $request->status
        ];
        
        $rules = [
           'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
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

        if(Product::create($input)){
            return redirect()->back()->with(['success'=>'Product created successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Something went wrong with creating product']);
        }
    }

    public function edit($id){
        $item = Product::findOrFail($id);
        return view("admin.pages.products.edit",compact('item'));
    }
    
    public function update(Request $request){
        $item = Product::findOrFail($request->id);
        if($item){
            $input['name'] = $request->name;
            $input['description'] = $request->description;
            $input['price'] = $request->price;
            $input['status'] = $request->status;

            $rules['name'] = 'required';
            $rules['description'] = 'required';
            $rules['price'] = 'required|numeric';
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

            if(Product::where("id",$item->id)->update($input)){
                return redirect()->back()->with(['success'=>'Product updated successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong with updating product']);
            }
           
        }else{
            return redirect()->back()->with(['error'=>'Data not found']);
        }
    }

    public function destroy($id){
        $item = Product::findOrFail($id);
        if($item){
            if(Product::where("id",$item->id)->delete()){
                return redirect()->back()->with(['success'=>'Product Deleted Successfully']);
            }else{
                return redirect()->back()->with(['error'=>'Something went wrong with deleting record']);
            }
            
        }else{
            return redirect()->back()->with(['error'=>'Data not found']);
        }
    }
}
