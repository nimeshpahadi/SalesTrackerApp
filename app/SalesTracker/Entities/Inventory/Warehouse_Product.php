<?php

namespace App\SalesTracker\Entities\Inventory;

use Illuminate\Database\Eloquent\Model;

class Warehouse_Product extends Model
{
    public $table = "warehouse_product";


    protected $fillable = [
        'warehouse_id', 'product_id', 'quantity'
    ];


}
