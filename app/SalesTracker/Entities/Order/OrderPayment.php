<?php

namespace App\SalesTracker\Entities\Order;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    public $table='order_payments';
    public $timestamps = false;
    public $fillable=[
        'user_id',
        'distributor_id',
        'amount',
        'type',
        'bank_name',
        'cheque_no',
        'cheque_date',
        'remark',
           ];
}
