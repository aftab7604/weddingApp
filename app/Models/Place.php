<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;

class Place extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'description',
        'price',
        'status',
        'location',
    ];

    public function vendors(){
        return $this->belongsToMany(User::class,'place_vendor',"place_id","vendor_id")->using(PlaceVendor::class)->withPivot("id");
    }
}
