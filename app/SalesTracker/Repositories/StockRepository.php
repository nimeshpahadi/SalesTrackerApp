<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/27/16
 * Time: 7:21 PM
 */

namespace App\SalesTracker\Repositories;


use App\SalesTracker\Entities\Inventory\Stock_in;
use App\SalesTracker\Entities\Inventory\Stock_out;
use App\SalesTracker\Entities\Inventory\Warehouse;
use App\SalesTracker\Entities\Inventory\Warehouse_Product;
use App\SalesTracker\Entities\Order\Order_out;
use App\SalesTracker\Entities\Product\Product;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class StockRepository
{
    /**
     * @var Stock_in
     */
    public $stock_in;
    /**
     * @var Stock_out
     */
    public $stock_out;
    /**
     * @var Warehouse
     */
    public $warehouse;
    /**
     * @var Product
     */
    public $product;
    /**
     * @var Warehouse_Product
     */
    public $warehouse_Product;
    /**
     * @var Log
     */
    private $log;
    /**
     * @var Order_out
     */
    private $order_out;

    /**
     * StockRepository constructor.
     * @param Stock_in $stock_in
     * @param Stock_out $stock_out
     * @param Warehouse $warehouse
     * @param Product $product
     * @param Warehouse_Product $warehouse_Product
     * @param Log $logger
     */
    public function __construct(Stock_in $stock_in, Order_out $order_out, Stock_out $stock_out, Warehouse $warehouse, Product $product, Warehouse_Product $warehouse_Product, Log $log)
    {
        $this->stock_in = $stock_in;
        $this->stock_out = $stock_out;
        $this->warehouse = $warehouse;
        $this->product = $product;
        $this->warehouse_Product = $warehouse_Product;
        $this->log = $log;
        $this->order_out = $order_out;
    }

    /**
     * get all data from stockin table
     * @return mixed
     */
    public function getallstockin()
    {
        $query = $this->stock_in->select('*');
        return $query->get();
    }

    /**
     * get all data of warehouse table
     * @return mixed
     */
    public function getall_warehouse()
    {
        $query = $this->warehouse->select('*');
        return $query->get();
    }

    /**
     * insert stocks in db
     * @param $request
     * @return mixed
     */
    public function storestockin($request)
    {
        try {
            $this->stock_in->insert($request);
            $this->log->info("Stock Created");
            return true;
        } catch (Exception $e) {
            $this->log->error("Stock Creation Failed");
            return false;
        }
    }

    /**
     * get all data of warehouse
     * @return mixed
     */
    public function allwarehouse()
    {
        $query = $this->warehouse->select('*');
        return $query->get();
    }

    /**
     * get required data for stockin
     * @return mixed
     */
    public function get_warehouse_name()
    {
        $query = $this->stock_in->select('stock_ins.id', 'warehouses.name as warehouse_name', 'warehouses.location as warehouse_loc', 'warehouses.id as ware_id',
            'products.sub_category as product_subcatname', 'products.id as prod_id', 'quantity', 'created_by',
            'stock_ins.created_at', 'stock_ins.updated_at')
            ->leftjoin('warehouses', 'stock_ins.warehouse_id', 'warehouses.id')
            ->leftjoin('products', 'stock_ins.product_id', 'products.id');
//dd($query->toSql());
        return $query->get();
    }



//

//    /**
//     * get stock in as per warehouse
//     * @return mixed
//     */
    /*  public function get_warehouse_stock()
        {
            $query = $this->stock_in->select(DB::raw('warehouses.name as ware_name, products.sub_category as prod_subcat,
            products.name as prod_name, sum(stock_ins.quantity) as total_stocksin,stock_ins.product_id as pid, stock_ins.warehouse_id as wid'))
                ->join('warehouses', 'stock_ins.warehouse_id', 'warehouses.id')
                ->join('products', 'stock_ins.product_id', 'products.id')
                ->groupBy('stock_ins.product_id', 'stock_ins.warehouse_id');
    //dd($query)->get();
            return $query->get();
        }*/


    public function get_warehouse_stock()
    {
        $query = $this->stock_in->select(DB::raw('warehouses.name as ware_name, products.sub_category as prod_subcat,
        sum(stock_ins.quantity) as total_stocksin, sum(stock_outs.quantity) as total_stocksout,
        stock_ins.product_id as pid, stock_ins.warehouse_id as wid'))
            ->join('warehouses', 'stock_ins.warehouse_id', 'warehouses.id')
            ->join('products', 'stock_ins.product_id', 'products.id')
            ->join('orders', 'orders.product_id', 'products.id')
            ->join('order_outs', 'order_outs.order_id', 'orders.id')
            ->join('stock_outs', 'stock_outs.order_out_id', 'order_outs.id')
            ->groupBy('stock_ins.warehouse_id', 'stock_ins.product_id');
        return $query->get();
    }


    public function get_stockdetail($id)
    {

        $query = $this->stock_in->select('stock_ins.id', 'warehouses.name as warehouse_name', 'warehouses.id as ware_id',
            'products.sub_category as product_subcatname', 'products.id as prod_id', 'quantity', 'created_by',
            'stock_ins.created_at', 'stock_ins.updated_at')
            ->leftjoin('warehouses', 'stock_ins.warehouse_id', 'warehouses.id')
            ->leftjoin('products', 'stock_ins.product_id', 'products.id')
            ->where('stock_ins.id', $id);

        return $query->get($id);
    }

    public function getstockbyid($id)
    {
        $query = $this->stock_in->find($id);
        return $query;
    }

    public function updatestock($request, $id)
    {
        try {
            // return $this->stock_in->update($request,$id);
            $query = Stock_in::find($id);
            $query->product_id = $request->product_id;
            $query->warehouse_id = $request->warehouse_id;
            $query->quantity = $request->quantity;
            $query->created_by = $request->created_by;
            $query->save();
            $this->log->info("Stock updated", ["id" => $id]);
            return true;
        } catch (Exception $e) {
            $this->log->error("Stock Update Failed.", ["id" => $id]);
            return false;
        }
    }

    /**
     * get stockin history as per warehouse and product
     * @param $pid
     * @param $wid
     * @return mixed
     */
    public function getStockinHistory($pid, $wid)
    {
        $query = $this->stock_in->select('stock_ins.id', 'warehouses.name as warehouse_name', 'warehouses.location as warehouse_loc', 'warehouses.id as ware_id',
            'products.sub_category as product_subcatname', 'products.id as prod_id', 'quantity', 'created_by',
            'stock_ins.created_at', 'stock_ins.updated_at')
            ->leftjoin('warehouses', 'stock_ins.warehouse_id', 'warehouses.id')
            ->leftjoin('products', 'stock_ins.product_id', 'products.id')
            ->where('stock_ins.product_id', '=', $pid)
            ->where('stock_ins.warehouse_id', '=', $wid);
        return $query->get();
    }

    /**
     * get stockout history as per warehouse and product
     * @param $pid
     * @param $wid
     * @return mixed
     */
    public function getStockoutHistory($pid, $wid)
    {
        $query = $this->stock_out->select('stock_outs.id', 'warehouses.name as warehouse_name', 'warehouses.id as ware_id',
            'products.sub_category as product_subcatname', 'products.id as prod_id', 'stock_outs.quantity', 'users.fullname as username',
            'stock_outs.created_at', 'stock_outs.updated_at')
            ->leftjoin('order_outs', 'stock_outs.order_out_id', 'order_outs.id')
            ->leftjoin('orders', 'orders.id', 'order_outs.order_id')
            ->leftjoin('warehouses', 'order_outs.warehouse_id', 'warehouses.id')
            ->leftjoin('products', 'orders.product_id', 'products.id')
            ->leftjoin('users', 'users.id', 'stock_outs.dispatched_by')
            ->where('orders.product_id', '=', $pid)
            ->where('order_outs.warehouse_id', '=', $wid);
        return $query->get();
    }

    public function getOrderWarehouse($id)
    {
        $query = $this->order_out->select('order_outs.id','order_outs.order_id', 'order_outs.created_at as senddate','distributor_details.company_name as distributor',
            'distributor_details.id as dis_id','products.sub_category as productname','users.fullname as username')
            ->join('orders', 'order_outs.order_id', 'orders.id')
            ->join('users', 'order_outs.user_id', 'users.id')
            ->join('products', 'orders.product_id', 'products.id')
            ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id')
            ->where('order_outs.warehouse_id', $id);
        
        return $query->get();
    }

    public function getStockoutbyOrder($id)
    {
        $query = $this->stock_out->select('stock_outs.id', 'stock_outs.dispatched_by', 'stock_outs.created_at', 'stock_outs.order_out_id',
            'order_outs.id as orderoutid', 'order_outs.order_id as orderid', 'users.fullname as username')
            ->join('order_outs', 'stock_outs.order_out_id', 'order_outs.id')
            ->join('users', 'stock_outs.dispatched_by', 'users.id')
            ->join('orders', 'order_outs.order_id', 'orders.id')
            ->where('orders.id', $id)
            ->groupBy('order_outs.order_id')
            ->first();
        return $query;


    }

    public function getStockoutqty()
    {

        $query = $this->stock_out->select(DB::raw('order_outs.order_id as orderid,sum(orders.quantity) as qty ,
         warehouses.id as wareid ,products.sub_category as subcat'))
            ->join('order_outs', 'stock_outs.order_out_id', 'order_outs.id')
            ->join('orders', 'order_outs.order_id', 'orders.id')
            ->join('warehouses', 'warehouses.id', 'order_outs.warehouse_id')
            ->join('products', 'products.id', 'orders.product_id')
            ->groupBy('products.sub_category', 'warehouses.id');
        return $query->get();

    }


    public function getwarehouse($userInfo)
    {
        $query = $this->warehouse->select('warehouses.id', 'name', 'location');
        if ($userInfo['role'] == "factoryincharge") {
            $query->join('factoryincharge_warehouses', 'warehouses.id', 'factoryincharge_warehouses.warehouse_id')
                ->where('factoryincharge_warehouses.user_id', '=', $userInfo['id']);


        }
        return $query->get();
    }

    public function getwareproduct($ware_id)
    {
        $query = $this->warehouse_Product->select('products.sub_category', 'products.id as pid')
            ->join('products', 'warehouse_product.product_id', 'products.id')
            ->where('warehouse_product.warehouse_id', $ware_id);
        return $query->get();
    }

    public function getstockin($wareId, $id)
    {
        $query = $this->stock_in->select(DB::raw('stock_ins.id ,  sum(quantity) as qty, created_by,
                                    stock_ins.created_at, stock_ins.updated_at'))
            ->where('stock_ins.product_id', $id)
            ->where('warehouse_id', $wareId);
        return $query->get();
    }

    public function getstockout($wareId, $id)
    {
        $query = $this->stock_out->select(DB::raw('stock_outs.id,sum(stock_outs.quantity) as qty, dispatched_by,
                                    stock_outs.created_at, stock_outs.updated_at'))
            ->join('order_outs', 'stock_outs.order_out_id', 'order_outs.id')
            ->join('orders', 'order_outs.order_id', 'orders.id')
            ->join('products', 'products.id', 'orders.product_id')
            ->where('orders.product_id', $id)
            ->where('order_outs.warehouse_id', $wareId);
        return $query->get();
    }

    public function getallstockout()
    {
        $query = $this->stock_out->select('stock_outs.id', 'warehouses.name as warehouse_name', 'warehouses.id as ware_id',
            'products.sub_category as product_subcatname', 'products.id as prod_id', 'stock_outs.quantity', 'users.fullname as username',
            'stock_outs.created_at', 'stock_outs.updated_at')
            ->leftjoin('order_outs', 'stock_outs.order_out_id', 'order_outs.id')
            ->leftjoin('orders', 'orders.id', 'order_outs.order_id')
            ->leftjoin('warehouses', 'order_outs.warehouse_id', 'warehouses.id')
            ->leftjoin('products', 'orders.product_id', 'products.id')
            ->leftjoin('users', 'users.id', 'stock_outs.dispatched_by');
//        dd($query->toSql());
        return $query->get();
    }

}























