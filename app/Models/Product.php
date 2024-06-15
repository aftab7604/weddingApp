<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Service;

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
        return $this->belongsToMany(Service::class,'product_service',"product_id","service_id");
    }

}
