<?php

namespace App\SalesTracker\Entities\Order;

use Illuminate\Database\Eloquent\Model;

class OrderApproval extends Model
{
    public $table = 'order_approvals';
    public $fillable = [
        'order_id',

        'marketingmanager',
        'salesmanager',
        'admin',
        'sales_approval',
        'marketing_approval',
        'admin_approval'
    ];
}
