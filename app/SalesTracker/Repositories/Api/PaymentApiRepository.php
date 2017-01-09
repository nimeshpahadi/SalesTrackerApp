<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/8/16
 * Time: 12:55 PM
 */

namespace App\SalesTracker\Repositories\Api;


use App\SalesTracker\Entities\Order\OrderPayment;
use Illuminate\Support\Facades\DB;

class PaymentApiRepository
{
    /**
     * @var OrderPayment
     */
    private $orderPayment;

    /**
     * PaymentApiRepository constructor.
     * @param OrderPayment $orderPayment
     */
    public function __construct(OrderPayment $orderPayment)
    {
        $this->orderPayment = $orderPayment;
    }

    /**
     * @param $paymentRepo
     * @return static
     */
    public function createPaymentRepo($paymentRepo)
    {
        return $this->orderPayment->create($paymentRepo);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAllPayment($id)
    {
        $query = DB::table('order_payments')
                        ->join('distributor_details', 'order_payments.distributor_id', '=', 'distributor_details.id')
                        ->select('order_payments.*', 'distributor_details.contact_name')
                        ->orderBy('order_payments.created_at', 'desc')
                        ->where('order_payments.distributor_id', '=', $id);

        if (is_null($query)) {

            return null;
        }

        return $query->get()->toArray();
    }
}