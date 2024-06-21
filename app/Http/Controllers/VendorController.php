<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = User::where("user_type",2)->with(['services.products', 'places'])->get()->toArray();
        return response()->json($vendors);
    }

    public function show($id)
    {
        $vendor = User::with(['services.products', 'places'])->findOrFail($id);
        return response()->json($vendor);
    }
}
