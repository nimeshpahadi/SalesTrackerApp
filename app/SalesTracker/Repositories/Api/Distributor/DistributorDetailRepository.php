<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/21/16
 * Time: 11:39 AM
 */

namespace App\SalesTracker\Repositories\Api\Distributor;


use App\SalesTracker\Entities\Distributor\DistributorDetails;
use Illuminate\Support\Facades\DB;

class DistributorDetailRepository
{
    /**
     * @var DistributorDetails
     */
    public $distributorDetails;

    /**
     * DistributorDetailRepository constructor.
     * @param DistributorDetails $distributorDetails
     */
    public function __construct(DistributorDetails $distributorDetails)
    {
        $this->distributorDetails = $distributorDetails;
    }

    /**
     * @param $dist_details
     * @return static
     */
    public function insertDetails($dist_details)
    {
        return $this->distributorDetails->create($dist_details);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDistDetail($id)
    {
        $query = DB::table('distributor_details')
                         ->join('order_payments', 'distributor_details.id', '=', 'order_payments.distributor_id')
                         ->select('distributor_details.*', DB::raw('sum(order_payments.amount) as paid_amount'))
                         ->where('distributor_details.id', '=', $id);

        return $query->get()->toArray();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getOrderBillings($id)
    {
        $query = DB::table('order_billings')
                        ->join('orders', 'order_billings.order_id', '=', 'orders.id')
                        ->join('distributor_details', 'orders.distributor_id', '=', 'distributor_details.id')
                        ->select(DB::raw('sum(order_billings.grand_total) as billing_amount'))
                        ->where('distributor_details.id', '=', $id);

        return $query->get()->toArray();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDistAddress($id)
    {
        $query = DB::table('distributor_addresses')
                         ->select('*')
                         ->where('distributor_id', '=', $id);

        if (is_null($query)) {
            return null;
        }

        return $query->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllDetail()
    {
        $query = $this->distributorDetails->all();

        return $query;
    }
}