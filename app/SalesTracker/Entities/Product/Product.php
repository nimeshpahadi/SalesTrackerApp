<?php

namespace App\SalesTracker\Entities\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';
    public $fillable = [
        'category',
        'sub_category',
        'name',
        'code',
        'description',
        'price',
        'image'

    ];
}
