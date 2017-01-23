<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/28/16
 * Time: 4:09 PM
 */

namespace App\SalesTracker\Repositories\Api;


use App\SalesTracker\Entities\Order\Order;
use Illuminate\Support\Facades\DB;

class OrderApiRepository
{
    /**
     * @var Order
     */
    public $order;

    /**
     * OrderApiRepository constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @param $ordersRepo
     * @return static
     */
    public function createOrderRepo($ordersRepo)

    {
        return $this->order->create($ordersRepo);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getOrderDetails($id)
    {
        $query = DB::table('orders')
                        ->select('*')->where('id', '=', $id);

        if (is_null($query)) {
            return null;
        }

        return $query->get()->toArray();
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateOrderRepo($request, $id)
    {
        $query = $this->order->find($id);

        if (is_null($query)) {
            return null;
        }

        $query->product_id             = $request['product_id'];
        $query->quantity               = $request['quantity'];
        $query->price                  = $request['price'];
        $query->priority               = $request['priority'];
        $query->payment_term           = $request['payment_term'];
        $query->proposed_delivery_date = $request['proposed_delivery_date'];
        $query->order_remark           = $request['order_remark'];

        $data = $query->save();

        return $data;
    }

    /**
     * @param $id
     * @param $date
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUserOrder($id, $date)
    {
        $query = DB::table('orders')
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->join('distributor_details', 'orders.distributor_id', '=', 'distributor_details.id')
                        ->select('orders.*', 'distributor_details.contact_name', 'products.sub_category')
                        ->where('orders.user_id', '=', $id)
                        ->whereDate('orders.created_at', $date);

        if (is_null($query)) {

            return null;
        }

        return $query->get()->toArray();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDistOrder($id)
    {
        $query = DB::table('orders')
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->join('distributor_details', 'orders.distributor_id', '=', 'distributor_details.id')
                        ->select('orders.*', 'distributor_details.contact_name', 'products.sub_category')
                        ->orderBy('orders.created_at', 'desc')
                        ->where('orders.distributor_id', '=', $id);

        if (is_null($query)) {

            return null;
        }

        return $query->get()->toArray();
    }
}