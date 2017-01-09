<?php

namespace App\SalesTracker\Entities\Order;

use Illuminate\Database\Eloquent\Model;

class OrderBilling extends Model
{
    public $table='order_billings';
    public $timestamps = false;
    public $fillable=['order_id',
        'user_id',
        'total_price',
        'discount',
        'vat',
        'shipping_charge',
        'grand_total'
    ];
}
