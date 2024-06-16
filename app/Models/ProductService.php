<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductService extends Pivot
{
    protected $table = 'product_service'; // The pivot table name
}
