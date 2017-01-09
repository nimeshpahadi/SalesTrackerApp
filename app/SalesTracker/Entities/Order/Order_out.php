<?php

namespace App\SalesTracker\Entities\Order;

use Illuminate\Database\Eloquent\Model;

class Order_out extends Model
{
    public $table = 'order_outs';
    public $timestamps = false;
    public $fillable = [
        'warehouse_id',
        'user_id',
        'order_id',
          ];
}
