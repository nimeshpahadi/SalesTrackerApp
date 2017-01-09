<?php

namespace App\SalesTracker\Entities\Inventory;

use Illuminate\Database\Eloquent\Model;

class Stock_in extends Model
{
    public $table = "stock_ins";
    public $timestamps = false;

    protected $fillable = [
        'warehouse_id', 'quantity', 'product_id', 'created_by'
    ];
}
