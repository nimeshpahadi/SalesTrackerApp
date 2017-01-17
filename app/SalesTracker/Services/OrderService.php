<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 12/6/16
 * Time: 12:48 AM
 */

namespace App\SalesTracker\Services;


use App\SalesTracker\Repositories\OrderRepository;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getOrderList()
    {
        $data=$this->orderRepository->getorderlist();
        return $data;
    }

    public function getOrderListDetails(){
        $data=$this->orderRepository->getorderlistdetail();
        return $data;
    }


    public function getOrderQuantiySum(){
        $data=$this->orderRepository->getOrderQuantitySumRepo();

        return $data;
    }

    public function getOrders(){
        $data=$this->orderRepository->getOrdersRepo();
        return $data;
    }

    /**
     * get specific order id
     * @param $id
     * @return mixed
     */
    public function getorderbyid($id)
    {
        $data=$this->orderRepository->getOrderId($id);
        return $data;
    }

    /**
     *
     * @param $request
     * @return bool
     */
    public function OrderBilling($request)
    {
        $formData = $request->all();
        $formData = array_except($formData, ['_token', 'to', 'remove']);
        $data=$this->orderRepository->orderBilling($formData);
        return $data;
    }

    public function getcountorderBilling($id)
    {
        $data=$this->orderRepository->getCountBilling($id);
        return $data;
    }

    public function getApprovalbyOrderid($id)
    {
        $data=$this->orderRepository->getApprovalbyorderid($id);
        return $data;
    }

    public function OrderPayment($request)
    {
        $formData = $request->all();
        $formData = array_except($formData, ['_token', 'to', 'remove']);
        $data=$this->orderRepository->orderpayment($formData);
        return $data;
    }

    public function getpayment($id)
    {
        $data=$this->orderRepository->getPayment($id);
        return $data;
    }

    public function getDistributororder($id)
    {
        $data=$this->orderRepository->getDistributororder($id);
        return $data;
    }

    public function getDistributorpayment($id)
    {
        $data=$this->orderRepository->getpaymentdistributor($id);
        return $data;
    }

    public function getOrderlistdistributor($id)
    {
        $data=$this->orderRepository->getorderlistbydistributor($id);
        return $data;
    }

    public function OrderApproval($request)
    {
        $formData = $request->all();
        $formData = array_except($formData, ['_token', 'to', 'remove']);
        $formData = array_except($formData, ['remark', 'to', 'remove']);
//dd($formData);
        $data=$this->orderRepository->orderapproval($formData);
        return $data;
    }

    public function OrderApprovalUpdate($request, $id)
    {
        $data=$this->orderRepository->orderapprovalupdate($request,$id);
        return $data;
    }

    public function getUserRole()
    {
        $data=$this->orderRepository->getuserrole();
        return $data;
    }

    public function getSalesmanApproval($id)
    {
        $data=$this->orderRepository->getsalesmanagerapproval($id);
        return $data;
    }

    public function getMarketingApproval($id)
    {
        $data=$this->orderRepository->getmarketingmanagerapproval($id);
        return $data;
    }

    public function getAdminApproval($id)
    {
        $data=$this->orderRepository->getadminapproval($id);
        return $data;
    }

    public function filterOrders($filters)
    {
        $orders = $this->orderRepository->filterOrders($filters);
        return $orders;
    }

    public function orderout($request)
    {
        $formData = $request->all();
        $formData = array_except($formData, ['_token', 'to', 'remove']);
        $data = $this->orderRepository->OrderOut($formData);
        return $data;
    }

    public function getorderoutdetail_id($id)
    {
        $orders = $this->orderRepository->getOrderOutDetailId($id);
        return $orders;
    }
    public function unDispatchedOrder()
    {
        $orders = $this->orderRepository->undispatchedorder();
        return $orders;
    }

    public function orderDispatch($request)
    {
        $formData = $request->all();
        $formData = array_except($formData, ['_token', 'to', 'remove']);
        $data = $this->orderRepository->OrderDispatch($formData);
        return $data;
    }

    public function getOrderApprovalAccount()
    {
        $order = $this->orderRepository->getorderapprovalAcccount();
        return $order;
    }

    public function getOrderApprovalsales()
    {
        $order = $this->orderRepository->getorderapprovalsales();
        return $order;
    }

    /**
     * @return mixed
     */
    public function todaySale()
    {
        $data=$this->orderRepository->todaySaleRepo();
        return $data;
    }

    /**
     * @return mixed
     */
    public function todayAmount()
    {
        $data=$this->orderRepository->todayAmountRepo();
        return $data;
    }

    public function updateAdminOrder($formData,$role)
    {
        $data = $this->orderRepository->orderAdminUpdate($formData,$role);

        return $data;
    }

    public function getOrderApprovaladmin()
    {
        $order = $this->orderRepository->getorderapprovalAdmin();
        return $order;
    }

    public function getallordersdetail($id)
    {
        $order = $this->orderRepository->getorderapprovaldetail($id);
        return $order;
    }

    /**
     * @return mixed
     */
    public function billingAmount()
    {
        $data=$this->orderRepository->billingAmountRepo();

        return $data;
    }

    /**
     * @return mixed
     */
    public function payingAmount()
    {
        $data=$this->orderRepository->payingAmountRepo();

        return $data;
    }

    public function getOrderApproval($orderId)
    {
        $ordApp=$this->orderRepository->gerorderapproval($orderId);
        return $ordApp;
    }
}