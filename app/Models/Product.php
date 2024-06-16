<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Service;
use App\Models\Order;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'description',
        'price',
        'status',
    ];

    public function services(){
        return $this->belongsToMany(Service::class,'product_service',"product_id","service_id")->using(ProductService::class)->withPivot("id");
    }

    public function orders(){
        return $this->belongsToMany(Order::class,'order_product',"product_id","order_id");
    }

}
