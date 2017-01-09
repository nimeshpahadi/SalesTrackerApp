<?php

namespace App\SalesTracker\Entities\Inventory;

use Illuminate\Database\Eloquent\Model;

class Stock_out extends Model
{
    public $table = "stock_outs";
    public $timestamps = false;


    protected $fillable = [
        'dispatched_by', 'order_out_id','quantity'
    ];
}
