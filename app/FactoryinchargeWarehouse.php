<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactoryinchargeWarehouse extends Model
{
public $table='factoryincharge_warehouses';
    public $fillable=[
        'user_id',
        'warehouse_id'
    ];
}
