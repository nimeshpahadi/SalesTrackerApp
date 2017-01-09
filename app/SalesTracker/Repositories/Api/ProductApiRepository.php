<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/28/16
 * Time: 1:28 PM
 */

namespace App\SalesTracker\Repositories\Api;


use App\SalesTracker\Entities\Product\Product;

class ProductApiRepository
{
    /**
     * @var Product
     */
    public $product;

    /**
     * ProductApiRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllProduct()
    {
        return $this->product->all();
    }
}