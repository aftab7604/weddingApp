<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Service;
use App\Models\Place;
use App\Models\User;
use Auth;


class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $rules = [
            'order_date' => 'required|date',
            'order_details' => 'nullable|string',
            'place_id' => 'required|exists:places,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.service_id' => 'required|exists:services,id',
            'products.*.vendor_id' => 'required|exists:users,id',
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
            $place = Place::find($request->place_id);

            $order = Order::create([
                'user_id' => $user_id,
                'place_id'=>$request->place_id,
                'total_amount'=>$place->price,
                'order_details'=>$request->order_details,
                'order_date'=>$request->order_date,
            ]);

            $total_price = $place->price;

            foreach ($request->products as $k=>$v) {
                $product = Product::find($v['product_id']);
                $total_price += $product->price;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $v['product_id'],
                    'service_id' => $v['service_id'],
                    'vendor_id' => $v['vendor_id'],
                ]);
            }

            Order::where("id",$order->id)->update(["total_amount"=>$total_price]);
            $order = Order::find($order->id);
            
            return response()->json([
                "success"=>true,
                "message"=>"Order Placed",
                "order"=>$order
            ], 200);
        }
    }

    public function getOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::where("user_id",$user_id)->with(['orderItems.product', 'orderItems.service', 'orderItems.vendor','place' ,'user'])->get()->toArray();
        if(!empty($orders)){
            return response()->json([
                "success"=>true,
                "message"=>"Order List",
                "orders"=>$orders
            ], 200);
        }else{
            return response()->json([
                "success"=>false,
                "message"=>"Orders not found",
                "orders"=>null
            ], 201);
        }
    }

    public function getOrderById($id){
        $order = Order::where("id",$id)->with(['orderItems.product', 'orderItems.service', 'orderItems.vendor','place' ,'user'])->first()->toArray();
        if(!empty($order)){
            return response()->json([
                "success"=>true,
                "message"=>"Order Found",
                "order"=>$order
            ], 200);
        }else{
            return response()->json([
                "success"=>false,
                "message"=>"Order not found",
                "orders"=>null
            ], 201);
        }
    }
}
