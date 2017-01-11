<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 12/6/16
 * Time: 12:28 AM
 */

namespace App\SalesTracker\Repositories;


use App\SalesTracker\Entities\Distributor\DistributorDetails;
use App\SalesTracker\Entities\Inventory\Stock_out;
use App\SalesTracker\Entities\Order\Order;
use App\SalesTracker\Entities\Order\Order_out;
use App\SalesTracker\Entities\Order\OrderApproval;
use App\SalesTracker\Entities\Order\OrderBilling;
use App\SalesTracker\Entities\Order\OrderPayment;
use App\SalesTracker\Entities\Product\Product;
use App\User;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    /**
     * @var Order
     */
    private $order;
    /**
     * @var Product
     */
    private $product;
    /**
     * @var DistributorDetails
     */
    private $distributorDetails;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Payment
     */

    /**
     * @var Log
     */
    private $log;
    /**
     * @var OrderBilling
     */
    private $orderBilling;
    /**
     * @var OrderPayment
     */
    private $orderPayment;
    /**
     * @var OrderApproval
     */
    private $orderApproval;
    /**
     * @var Order_out
     */
    private $order_out;
    /**
     * @var Stock_out
     */
    private $stock_out;

    public function __construct(Order $order, Product $product,
                                DistributorDetails $distributorDetails, User $user,OrderBilling $orderBilling,
                                OrderPayment $orderPayment,Stock_out $stock_out, OrderApproval $orderApproval, Order_out $order_out,Log $log)
    {

        $this->order = $order;
        $this->product = $product;
        $this->distributorDetails = $distributorDetails;
        $this->user = $user;

        $this->log = $log;
        $this->orderBilling = $orderBilling;
        $this->orderPayment = $orderPayment;
        $this->orderApproval = $orderApproval;
        $this->order_out = $order_out;
        $this->stock_out = $stock_out;
    }

    public function getorderlist()
    {
        $order = $this->order->select('*');
        return $order->get();
    }


    /**
     * get order that is not approved by salesmanager
     * @param $role
     * @return mixed
     */
//
    public function getorderapprovalAcccount()
    {
        $query=$this->orderApproval->select(DB::raw('order_approvals.order_id'))
            ->join('users','users.id','order_approvals.marketingmanager')
            ->join('role_user','users.id','role_user.user_id')
            ->join('roles','roles.id','role_user.role_id')
            ->where('roles.name', "accountmanagersales")
            ->where('order_approvals.marketing_approval','Approved')
            ->groupby('order_approvals.order_id')
            ->distinct()->get();
//dd($query);
        $query1 = $this->order->select('orders.id','orders.distributor_id','orders.product_id','orders.user_id'
            ,'orders.quantity','orders.price','orders.priority','orders.payment_term',
            'orders.proposed_delivery_date','orders.created_at','products.sub_category as subCategory',
          'users.fullname as userName',
          'distributor_details.company_name as distributor_name')
            ->join('users', 'orders.user_id', 'users.id')
            ->join('products', 'orders.product_id', 'products.id')
            ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id')
                            ->whereNotIn('orders.id', $query);

        return $query1->get();
    }

    public function getorderapprovalsales()
    {
        $query=$this->orderApproval->select(DB::raw('order_approvals.order_id'))
            ->join('users','users.id','order_approvals.marketingmanager')
            ->join('role_user','users.id','role_user.user_id')
            ->join('roles','roles.id','role_user.role_id')
            ->where('roles.name', "accountmanagersales")
            ->where('order_approvals.sales_approval','<>','Approved')
            ->where('order_approvals.marketing_approval','Approved')

            ->get();
        $query1 = $this->order->select('orders.id','orders.distributor_id','orders.product_id','orders.user_id'
            ,'orders.quantity','orders.price','orders.priority','orders.payment_term',
            'orders.proposed_delivery_date','orders.created_at','products.sub_category as subCategory',
            'users.fullname as userName',
            'distributor_details.company_name as distributor_name')
            ->join('users', 'orders.user_id', 'users.id')
            ->join('products', 'orders.product_id', 'products.id')
            ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id')
            ->whereIn('orders.id', $query)
            ->get();
        return $query1;
    }


    /**
     * get the order list with details as per todays-date
     * @return mixed
     */
    public function getorderlistdetail()
    {
        $query = $this->order->select(DB::raw('orders.distributor_id,orders.quantity,orders.id, orders.price, orders.priority, orders.payment_term,
          orders.proposed_delivery_date,
          products.sub_category as subCategory,
          users.fullname as userName, 
          distributor_details.company_name as distributor_name'))
            ->join('users', 'orders.user_id', 'users.id')
            ->join('products', 'orders.product_id', 'products.id')
            ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id')
            ->whereRaw('DATE(orders.created_at) = CURRENT_DATE');
        return $query->get();
    }


    /**
     * get the total order number for the current date
     * @return mixed
     */
    public function gettotalordertoday()
    {
        $query = $this->order
                      ->join('distributor_details', 'orders.distributor_id', '=', 'distributor_details.id')
                      ->join('users', 'orders.user_id', '=', 'users.id')
                      ->join('products', 'orders.product_id', '=', 'products.id')
                      ->select(DB::raw('sum(orders.quantity) as total_order'), 'distributor_details.contact_name',
                                        'users.fullname', 'products.sub_category', 'orders.quantity',
                                        'orders.price', 'orders.proposed_delivery_date')
                      ->whereDate('orders.created_at',date('Y-m-d'));

        return $query->get();
    }


    /**
     *
     * get detail of order by the distributor
     * @return mixed
     */
    public function getorderlistbydistributor($id)
    {
        $query = $this->order->select(DB::raw('orders.*, products.sub_category as subCategory, users.fullname as userName, 
          distributor_details.company_name as distributor_name, orders.id as distributor_id'))
            ->orderBy('created_at', 'desc')
            ->join('users', 'orders.user_id', 'users.id')
            ->join('products', 'orders.product_id', 'products.id')
            ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id')
            ->join('order_approvals', 'order_approvals.order_id', 'orders.id')
            ->where('orders.distributor_id', $id)
            ->where('order_approvals.admin_approval', '<>', "Approved");
        return $query->get();
    }

    public function getOrderId($id)
    {
        $query = $this->order->select(DB::raw('orders.id,orders.quantity, orders.price, orders.priority, orders.payment_term,
          orders.proposed_delivery_date, orders.user_id as userId,orders.created_at,
          products.sub_category as subCategory,
          users.fullname as userName,distributor_details.id as distributor_id,
          distributor_details.company_name as distributor_name'))
            ->join('users', 'orders.user_id', 'users.id')
            ->join('products', 'orders.product_id', 'products.id')
            ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id')
            ->where('orders.id',$id)
             ->first();

        return $query;
    }

    public function orderBilling($formData)
    {
        try {

            $this->orderBilling->insert($formData);
            $this->log->info("Order billing Created");
            return true;
        } catch (QueryException $e) {
            $this->log->error("Oreder billing Creation Failed");
            return false;
        }
    }

    public function getCountBilling($id)
    {
        $query = $this->orderBilling->where('order_id', '=', $id)->get();
        return $query;
    }
    public function orderpayment($formData)
    {
        try {

            $this->orderPayment->insert($formData);
            $this->log->info("Order payment Created");
            return true;
        } catch (QueryException $e) {
            $this->log->error("Oreder Payment Creation Failed");
            return false;
        }
    }

    public function getPayment($id)
    {
        $query = $this->orderPayment->where('distributor_id', '=', $id)->get();
        return $query;
    }

    public function getDistributororder($id)
    {
        $query = $this->distributorDetails->where('id', '=', $id)->get();
        return $query;
    }

    public function getpaymentdistributor($id)
    {
        $query = $this->orderPayment->select(DB::raw('order_payments.amount,order_payments.type,order_payments.created_at,
                        users.fullname as userName,users.id as userId,distributor_details.id as distributor_id,
          distributor_details.company_name as distributor_name'))
            ->orderBy('created_at', 'desc')
            ->join('users', 'order_payments.user_id', 'users.id')
            ->join('distributor_details', 'order_payments.distributor_id', 'distributor_details.id')
            ->where('order_payments.distributor_id',$id);

        return $query->get();
    }

    public function orderapproval($formData)
    {
        try {
            $this->orderApproval->insert($formData);
            $this->log->info("Order Approval Created");
            return true;
        } catch (QueryException $e) {
            $this->log->error("Oreder Approval Creation Failed");
            return false;
        }
    }

    public function getApprovalbyorderid($id)
    {

        $query = $this->orderApproval->where('order_id', '=', $id)
                                     ->get();

        return $query;
    }
    public function getApprovaldetailbyorderid($id)
    {

        $query = $this->orderApproval->where('order_id', '=', $id)->get();
        return $query;
    }

    public function orderapprovalupdate($request, $id)
    {
        try {
            $approvalId= $this->orderApproval->find($id);
            $approvalId->marketing_approval = $request->marketing_approval;
            $approvalId->save();
            $this->log->info("Order Approval updated");
            return true;
        } catch (QueryException $e) {
            $this->log->error("Oreder Approval Update Failed");
            return false;
        }
    }


    public function getuserrole()
    {
        $query = $this->orderApproval->select('order_approvals.approval_status','order_approvals.order_id','roles.name as role_name',
            'users.id as user_id', 'roles.id as roles_id')
                            ->join('users', 'order_approvals.user_id', 'users.id')
                            ->join('role_user', 'order_approvals.user_id', 'role_user.user_id')
                            ->join('orders', 'order_approvals.order_id', 'orders.id')
                            ->join('roles', 'role_user.role_id', 'roles.id');

        return $query->get();
    }
    public function getsalesmanagerapproval($id)
    {
        $query = $this->orderApproval->select('order_approvals.id','order_approvals.sales_approval','order_approvals.order_id',
                                                 'order_approvals.salesmanager','users.fullname as user_name')
                                    ->join('users', 'users.id', 'order_approvals.salesmanager')
                                    ->join('role_user', 'users.id', 'role_user.user_id')
                                    ->join('orders', 'order_approvals.order_id', 'orders.id')
                                    ->where('orders.id',$id)
                                    ->first();
        return $query;
    }

    public function getmarketingmanagerapproval($id)
    {
        $query = $this->orderApproval->select('order_approvals.id','order_approvals.marketing_approval','order_approvals.order_id',
            'order_approvals.marketingmanager','users.fullname as user_name')
            ->join('users', 'users.id', 'order_approvals.marketingmanager')
            ->join('role_user', 'users.id', 'role_user.user_id')
            ->join('orders', 'order_approvals.order_id', 'orders.id')
            ->where('orders.id',$id)
            ->first();

        return $query;
    }

    public function getadminapproval($id)
    {
        $query = $this->orderApproval->select('order_approvals.*', 'users.fullname as user_name', 'roles.display_name')
            ->join('users', 'users.id', 'order_approvals.admin')
            ->join('role_user', 'users.id', 'role_user.user_id')
            ->join('roles', 'roles.id', 'role_user.role_id')
            ->join('orders', 'order_approvals.order_id', 'orders.id')
            ->where('orders.id',$id)->first();
        return $query;
    }

    public function filterOrders($filters)
    {
//        $query1=$this->stock_out->select('order_outs.order_id')
//                                ->join('order_outs','order_outs.id','stock_outs.order_out_id')->get();

        $query = $this->order->select(
                DB::raw('orders.quantity,orders.id,orders.distributor_id, orders.price, orders.priority, orders.payment_term,
                    orders.proposed_delivery_date,orders.created_at,
                    products.sub_category as subCategory,
                    users.fullname as userName,
                    distributor_details.company_name as distributor_name'))
                        ->join('users', 'orders.user_id', 'users.id')
                        ->join('products', 'orders.product_id', 'products.id')
                        ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id');
//                       ->whereNotIn('orders.id',$query1) ;


            if($filters['from']!=null)
            {
                $to = ($filters['to']==null)?date('Y-m-d'):$filters['to'];

                $query->whereRaw("DATE(orders.created_at) between ? AND ?",[$filters['from'],$to]);
            }


        if ($filters['distributor']!=null)
        {
            $query->where('distributor_id','=',$filters['distributor']);
        }

        return $query->get();
    }


    public function undispatchedorder(){
        $query1=$this->stock_out->select('order_outs.order_id')
                                ->join('order_outs','order_outs.id','stock_outs.order_out_id')->get();

        $query = $this->order->select(
            DB::raw('orders.quantity,orders.id,orders.distributor_id, orders.price, orders.priority, orders.payment_term,
                    orders.proposed_delivery_date,orders.created_at,
                    products.sub_category as subCategory,
                    users.fullname as userName,
                    distributor_details.company_name as distributor_name'))
                        ->join('users', 'orders.user_id', 'users.id')
                        ->join('products', 'orders.product_id', 'products.id')
                        ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id')
                       ->whereNotIn('orders.id',$query1) ;

        return $query->get();



    }

    public function OrderOut($formData)
    {
        try {
            $this->order_out->insert($formData);
            $this->log->info("Order out Created");
            return true;
        } catch (Exception $e) {
            $this->log->error("Order out Creation Failed");
            return false;
        }
    }

    public function getOrderOutDetailId($id)
    {
        $query = $this->order_out->select('order_outs.id as orderoutid','order_outs.created_at as senddate','distributor_details.company_name as distributor',
            'order_outs.order_id','orders.quantity as qty',
            'products.sub_category as productname','users.fullname as username','warehouses.name as warehousename')
            ->join('orders', 'order_outs.order_id', 'orders.id')
            ->join('users', 'order_outs.user_id', 'users.id')
            ->join('products', 'orders.product_id', 'products.id')
            ->join('warehouses', 'order_outs.warehouse_id', 'warehouses.id')
            ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id')
            ->where('orders.id',$id)->first();
        return $query;
    }

    public function OrderDispatch($formData)
    {
        try {
            $this->stock_out->insert($formData);
            $this->log->info("Order dispatched Created");
            return true;
        } catch (Exception $e) {
            $this->log->error("Order dispatch Creation Failed");
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function todaySaleRepo()
    {
        return $this->orderBilling->select(DB::raw('sum(order_billings.grand_total) as grand_total'))
            ->whereDate('created_at', 'Y-m-d')
            ->get();
    }

    /**
     * @return mixed
     */
    public function todayAmountRepo()
    {
        return $this->orderPayment->select(DB::raw('sum(order_payments.amount) as total_amount'))
            ->whereDate('created_at', 'Y-m-d')
            ->get();
    }

    public function orderAdminUpdate($formData,$role)
    {
        if ($role=="salesmanager")
        {
            $query = $this->orderApproval->where("order_id",$formData['order_id'])
                ->update(["salesmanager"=>$formData['user_id'],"sales_approval"=>$formData['sales_approval']])
            ;
        }
        if ($role=="admin" || $role=="generalmanager")
        {
            $query = $this->orderApproval  ->where("order_id",$formData['order_id'])
                ->update(["admin"=>$formData['user_id'],"admin_approval"=>$formData['admin_approval']]);
        }
        return $query;
    }

    public function getorderapprovalAdmin()
    {
        $query=$this->orderApproval->select(DB::raw('order_approvals.order_id'))
            ->join('users','users.id','order_approvals.salesmanager')
            ->join('role_user','users.id','role_user.user_id')
            ->join('roles','roles.id','role_user.role_id')
            ->where('roles.name', "salesmanager")
            ->where('order_approvals.sales_approval','Approved')
            ->where('order_approvals.admin_approval','<>','Approved')
            ->get();
        $query1 = $this->order->select('orders.id','orders.distributor_id','orders.product_id','orders.user_id'
            ,'orders.quantity','orders.price','orders.priority','orders.payment_term',
            'orders.proposed_delivery_date','orders.created_at','products.sub_category as subCategory',
            'users.fullname as userName',
            'distributor_details.company_name as distributor_name')
            ->join('users', 'orders.user_id', 'users.id')
            ->join('products', 'orders.product_id', 'products.id')
            ->join('distributor_details', 'orders.distributor_id', 'distributor_details.id')
            ->whereIn('orders.id', $query)
            ->get();
        return $query1;
    }

    public function getorderapprovaldetail($id)
    {
        $query=$this->orderApproval->select('order_approvals.order_id','order_approvals.admin'
            ,'order_approvals.salesmanager','order_approvals.marketingmanager'
            ,'order_approvals.sales_approval',
            'order_approvals.marketing_approval','order_approvals.admin_approval'
            ,'users.fullname as username','roles.name as rolename')
            ->join('users','users.id','order_approvals.salesmanager')
            ->join('role_user','users.id','role_user.user_id')
            ->join('roles','roles.id','role_user.role_id')
            ->where('order_approvals.order_id',$id)
//            ->where('order_approvals.salesmanager','role_role.user_id')
//            ->where('order_approvals.order_id',$id)
            ->get();
        return $query;
    }

    /**
     * @return mixed
     */
    public function billingAmountRepo()
    {
        return $this->orderBilling->select(DB::raw('sum(order_billings.grand_total) as billing_amount'))
                                        ->whereDate('created_at', date('Y-m-d'))
                                        ->get();
    }

    /**
     * @return mixed
     */
    public function payingAmountRepo()
    {
        return $this->orderPayment->select(DB::raw('sum(order_payments.amount) as paying_amount'))
                                        ->whereDate('created_at', date('Y-m-d'))
                                        ->get();
    }
}