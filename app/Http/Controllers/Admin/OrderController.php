<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Service;
use App\Models\Place;
use App\Models\User;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with(['orderItems.product', 'orderItems.service', 'orderItems.vendor','place' ,'user'])->get()->toArray();
        // dd($orders);
        return view('admin.pages.orders.orders', compact('orders'));
    }

    public function get_single_order($id){
        $order = Order::where("id",$id)->with(['orderItems.product', 'orderItems.service', 'orderItems.vendor','place' ,'user'])->first()->toArray();
        return view('admin.pages.orders.single', compact('order'));
    }
}
