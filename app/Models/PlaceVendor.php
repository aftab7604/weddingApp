<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlaceVendor extends Pivot
{
    protected $table = 'place_vendor'; // The pivot table name
}
