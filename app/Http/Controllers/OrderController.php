<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\Place;
use Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $user_id = Auth::user()->id;
        
        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'order_details' => 'nullable|string',
            'place_id' => 'required|exists:places,id',
            'products' => 'required|array',
        ]);

        $place_vendor = DB::table('place_vendor')->where('id', $validatedData['place_id'])->first();
        if($place_vendor){
            $place = Place::find($place_vendor->place_id);
        }
       
        $order = Order::create([
            'order_date' => $validatedData['order_date'],
            'order_details' => $validatedData['order_details'],
            'total_amount' => $place->price,
            'place_id' => $validatedData['place_id'],
            'user_id' => $user_id,
        ]);
        
        $total_price = $place->price;
        
        foreach ($validatedData['products'] as $productData) {
            $product_service = DB::table('product_service')->where('id', $productData)->first();
            if($product_service){
                $product = Product::find($product_service->product_id);
            }
          
            if ($product) {
                $total_price += $product->price;
                $order->products()->attach($product->id);
            }
        }

        Order::where("id",$order->id)->update(["total_amount"=>$total_price]);
        $order = Order::find($order->id);
        
        return response()->json([
            "success"=>true,
            "message"=>"Order Placed",
            "order"=>$order
        ], 201);
    }
}
