<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/28/16
 * Time: 12:12 AM
 */

namespace App\SalesTracker\Repositories;


use App\SalesTracker\Entities\Inventory\Warehouse;
use App\SalesTracker\Entities\Inventory\Warehouse_Product;
use App\SalesTracker\Entities\Product\Product;

class WarehouseRepository
{

    /**
     * @var Warehouse_Product
     */
    public $warehouse_Product;
    /**
     * @var Warehouse
     */
    public $warehouse;
    /**
     * @var Product
     */
    public $product;

    public function __construct(Warehouse_Product $warehouse_Product, Warehouse $warehouse, Product $product)
    {
        $this->warehouse_Product = $warehouse_Product;
        $this->warehouse = $warehouse;
        $this->product = $product;
    }

    public function warehouseproduct()
    {
        $query = $this->warehouse_Product->select('*');
        return $query->get();
    }

    public function get_warehouse_name()
    {

        $query = $this->warehouse_Product->select('warehouses.name as warehouse_name', 'warehouses.id as ware_id',
            'products.sub_category as product_subcatname', 'products.id as prod_id')
            ->join('warehouses', 'warehouse_product.warehouse_id', 'warehouses.id')
            ->join('products', 'warehouse_product.product_id', 'products.id');

        return $query->distinct()->get();
    }


}












