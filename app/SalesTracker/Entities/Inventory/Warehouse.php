<?php

namespace App\SalesTracker\Entities\Inventory;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public $table = "warehouses";


    protected $fillable = [
        'name', 'location', 'product_id'
    ];
}
