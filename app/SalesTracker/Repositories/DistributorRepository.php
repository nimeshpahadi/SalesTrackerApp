<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/20/16
 * Time: 9:23 AM
 */

namespace App\SalesTracker\Repositories;


use App\SalesTracker\Entities\Distributor\DistributorAddress;
use App\SalesTracker\Entities\Distributor\DistributorDetails;
use App\SalesTracker\Entities\Distributor\DistributorGuarantee;
use App\SalesTracker\Entities\Distributor\DistributorMinute;
use App\SalesTracker\Entities\Distributor\DistributorTracking;
use App\SalesTracker\Entities\Order\OrderBilling;
use App\SalesTracker\Entities\Order\OrderPayment;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class DistributorRepository
{
    /**
     * @var DistributorDetails|distributor_details
     */
    public $distributorDetails;
    /**
     * @var DistributorGuarantee
     */
    public $distributorGuarantee;
    /**
     * @var DistributorAddress
     */
    public $distributorAddress;
    /**
     * @var DistributorTracking
     */
    public $distributorTracking;
    /**
     * @var DistributorMinute
     */
    private $distributorMinute;
    /**
     * @var Log
     */
    private $log;
    /**
     * @var OrderBilling
     */
    private $billing;
    /**
     * @var OrderPayment
     */
    private $payment;


    /**
     * DistributorRepository constructor.
     * @param DistributorDetails $distributorDetails
     * @param DistributorTracking $distributorTracking
     * @param DistributorMinute $distributorMinute
     * @param DistributorGuarantee $distributorGuarantee
     * @param DistributorAddress $distributorAddress
     * @param Log $log
     * @param OrderBilling $billing
     * @param OrderPayment $payment
     */
    public function __construct(DistributorDetails $distributorDetails, DistributorTracking $distributorTracking,
                                DistributorMinute $distributorMinute,
                                DistributorGuarantee $distributorGuarantee,
                                DistributorAddress $distributorAddress, Log $log,
                                OrderBilling $billing, OrderPayment $payment)
    {

        $this->distributorDetails = $distributorDetails;
        $this->distributorGuarantee = $distributorGuarantee;
        $this->distributorAddress = $distributorAddress;
        $this->distributorTracking = $distributorTracking;
        $this->distributorMinute = $distributorMinute;
        $this->log = $log;
        $this->billing = $billing;
        $this->payment = $payment;
    }

    /**
     * @param $request
     */
    public function storesDistributor($request)
    {
        try {
            $this->distributorDetails->insert($request);
            $this->log->info("Customer Created");
            return true;
        } catch (QueryException $e) {
            $this->log->error("Customer Creation Failed");
            return false;
        }

    }

    public function updatedistributor($request, $id)
    {
        try {
            $query = DistributorDetails::find($id);
            $query->company_name = $request->company_name;
            $query->contact_name = $request->contact_name;
            $query->email = $request->email;
            $query->mobile = $request->mobile;
            $query->phone = $request->phone;
            $query->zone = $request->zone;
            $query->district = $request->district;
            $query->latitude = $request->latitude;
            $query->longitude = $request->longitude;
            $query->lead_source = $request->lead_source;
            $query->type = $request->type;
            $query->open_date = $request->open_date;
            $query->vat_no = $request->vat_no;
            $query->save();
            $this->log->info("Customer Updated", ['id' => $id]);

            return true;
        } catch (QueryException $e) {
            $this->log->error("Customer Update Failed", ['id' => $id]);
            return false;
        }
    }

    public function distributorslist()
    {
        $query = $this->distributorDetails->select('*')
                ->where('status',1);
        return $query->get();
    }

    public function guarantee_store($request)
    {
        try {

            $this->distributorGuarantee->insert($request);
            $this->log->info("Customer Guarantee Created");
            return true;
        } catch (QueryException $e) {
            $this->log->error("Customer Guarantee Creation Failed");
            return false;
        }
    }

    public function deleteDistributorID($id)
    {
        try {
            $query = $this->distributorDetails->find($id);
            $query->delete();
            $query;
            $this->log->info("Customer Deleted");
            return true;
        } catch (Exception $e) {
            $this->log->error("Customer Deletion Failed");
            return false;
        }
    }

    public function createAddress($request)
    {
        return $this->distributorAddress->insert($request);

    }

    public function createTrackings($dataSet)
    {

        try {
            $this->distributorTracking->create($dataSet);
            $this->log->info("Customer Tracking Created");
            return true;
        } catch (Exception $e) {
            $this->log->error("Customer Tracking Creation Failed");
            return false;
        }

    }


    public function updatedisaddress($request, $id)
    {

        try {
            $query = DistributorAddress::find($id);
            $query->type = $request->type;
            $query->distributor_id = $request->distributor_id;
            $query->zone = $request->zone;
            $query->district = $request->district;
            $query->city = $request->city;
            $query->latitude = $request->latitude;
            $query->longitude = $request->longitude;
            $query->mobile = $request->mobile;
            $query->phone = $request->phone;
            $query->fax = $request->fax;
            $query->save();
            $this->log->info("Customer Address Updated ");
            return true;

        } catch (Exception $e) {
            $this->log->error("Customer Address Update Failed");
            return false;
        }

    }

    public function updatedisguarantee($request, $id)
    {
        try {
            $query = DistributorGuarantee::find($id);
            $query->distributor_id = $request->distributor_id;
            $query->type = $request->type;
            $query->bank_name = $request->bank_name;
            $query->cheque_no = $request->cheque_no;
            $query->amount = $request->amount;
            $query->remark = $request->remark;
            $query->save();
            $this->log->info("Customer Guarantee Updated ");
            return true;
        } catch (Exception $e) {
            $this->log->error("Customer Guarantee Update Failed");
            return false;
        }
    }

    public function deleteDistributor_Address($id)
    {
        try {
            $query = $this->distributorAddress->find($id);
            $query->delete();
            $query;
            $this->log->info("Customer Address Deleted");
            return true;
        } catch (Exception $e) {
            $this->log->error("Customer Address Deletion Failed");
            return false;
        }
    }

    public function select_distributorID($id)
    {
        $query = $this->distributorDetails->find($id);
        return $query;
    }

    public function select_distributoraddress($id)
    {
        $query = $this->distributorAddress->where('distributor_id', '=', $id)->get();
        return $query;
    }

    public function select_distributorguarantee($id)
    {
        $query = $this->distributorGuarantee->where('distributor_id', '=', $id)->first();
        return $query;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function select_distributortracking($id)
    {
        $query = $this->distributorTracking->select('distributor_trackings.*', 'users.fullname as user_fullname')
                                    ->join('users', 'distributor_trackings.user_id', 'users.id')
                                    ->where('distributor_trackings.distributor_id', $id)
                                    ->whereDate('distributor_trackings.created_at', date('Y-m-d'))
                                    ->get();
        return $query;
    }

    public function storeMinute($request)
    {
        try {
            $this->distributorMinute->insert($request);
            $this->log->info("Customer Minute Created");
            return true;
        } catch (QueryException $e) {
            $this->log->error("Customer Minute Creation Failed");
            return false;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getMinute($id)
    {
        $query = $this->distributorMinute->select('distributor_minutes.*', 'distributor_minutes.report as minute_report',
                                                  'users.fullname as user_fullname')
                                ->leftjoin('users', 'distributor_minutes.user_id', 'users.id')
                                ->where('distributor_minutes.distributor_id', $id)
                                ->whereDate('distributor_minutes.created_at', date('Y-m-d'))
                                ->get();

        return $query;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getBillingRepo($id)
    {
        $query = DB::table('order_billings')
                        ->join('orders', 'order_billings.order_id', '=', 'orders.id')
                        ->join('distributor_details', 'orders.distributor_id', '=', 'distributor_details.id')
                        ->select(DB::raw('sum(order_billings.grand_total) as billing_amount'))
                        ->where('distributor_details.id', '=', $id)->get();

        return $query->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPayingRepo($id)
    {
        $query = DB::table('distributor_details')
                        ->join('order_payments', 'distributor_details.id', '=', 'order_payments.distributor_id')
                        ->select(DB::raw('sum(order_payments.amount) as paid_amount'))
                        ->where('distributor_details.id', '=', $id)->get();

        return $query->first();
    }
}