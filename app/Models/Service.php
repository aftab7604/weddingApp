<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Models\Product;

class Service extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'image',
        'name',
        'status',
    ];

    public function vendors(){
        return $this->belongsToMany(User::class,'service_vendor',"service_id","vendor_id");
    }

    public function products(){
        return $this->belongsToMany(Product::class,'product_service',"service_id","product_id");
    }
}
