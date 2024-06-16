<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'place_id',
        "total_amount",
        "order_details",
        "order_date",
    ];

    public function products(){
        return $this->belongsToMany(Product::class,'order_product',"order_id","product_id");
    }



}
