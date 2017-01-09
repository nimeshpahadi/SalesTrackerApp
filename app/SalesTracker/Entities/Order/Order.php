<?php
namespace App\SalesTracker\Entities\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';
    public $fillable = [
        'product_id',
        'user_id',
        'distributor_id',
        'quantity',
        'price',
        'priority',
        'payment_term',
        'proposed_delivery_date',

    ];
}