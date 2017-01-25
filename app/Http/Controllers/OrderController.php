<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\SalesTracker\Entities\Order\Order_out;
use App\SalesTracker\Entities\Order\OrderApprovalRemarks;
use App\SalesTracker\Services\DistributorService;
use App\SalesTracker\Services\OrderService;
use App\SalesTracker\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    /**
     * @var OrderService
     */
    private $orderService;
    /**
     * @var DistributorService
     */
    private $distributorService;
    /**
     * @var StockService
     */
    private $stockService;
    /**
     * @var OrderApprovalRemarks
     */
    private $orderApprovalRemarks;

    public function __construct( OrderService $orderService, DistributorService $distributorService,StockService $stockService,OrderApprovalRemarks $orderApprovalRemarks)
    {
        $this->middleware(['role:admin|salesman|salesmanager|factoryincharge|accountmanagersales|generalmanager|director']);
        $this->orderService = $orderService;
        $this->distributorService = $distributorService;
        $this->stockService = $stockService;
        $this->orderApprovalRemarks = $orderApprovalRemarks;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

    }


    public function filterOrder(Request $request)
    {
        $filters['from'] = $request->get('from',date('Y-m-d'));
        $filters['to'] = $request->get('to',date('Y-m-d'));
        $filters['distributor'] = $request->get('distributor');


        $dis=$this->distributorService->distributor_list();
        $order = $this->orderService->filterOrders($filters);
        $undispatched= $this->orderService->unDispatchedOrder();

        return view('order.index',compact('order','dis','ordertoday','filters','undispatched'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderId= $this->orderService->getorderbyid($id);
        $shipaddress=$this->distributorService->shippingAddress($orderId->distributor_id);

        $dispatched=$this->stockService->getstockoutbyorder($id);
        $orderout=$this->orderService->getorderoutdetail_id($id);
        $ware = $this->stockService->get_allwarehouse();
        $salesapproval=$this->orderService->getSalesmanApproval($id);
        $marketingapproval=$this->orderService->getMarketingApproval($id);
        $adminapproval=$this->orderService->getAdminApproval($id);
        $approvalremark=$this->orderService->getApprovalRemark($id);

        $order_billings=$this->orderService->getcountorderBilling($id);
        $order_payment=$this->orderService->getpayment($id);
        $order=$this->orderService->getOrderListDetails();
        return view('order.show',compact('order','orderId','order_payment','shipaddress','approvalremark','dispatched','order_billings','orderout','ware','order_approval','salesapproval','adminapproval','marketingapproval'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createPayment($id)
    {

        $orderId= $this->orderService->getorderbyid($id);
       $distId= $this->orderService->getDistributororder($id);

        return view('order.payment',compact('distId','orderId','id'));

    }

    public function orderBilling(OrderRequest $request)
    {
        $orderid = $request['order_id'];
        if ($this->orderService->OrderBilling($request)) {
            return redirect()->route('order.show', compact('orderid'))->withSuccess(" Billing created success");
        }
        return back()->withErrors("Something went wrong");
    }

    public function orderPayment(Request $request)
    {
        $distributorid = $request['distributor_id'];
        if ($this->orderService->OrderPayment($request)) {
            return redirect()->route('distributor.show', compact('distributorid'))->withSuccess(" Payment created success");
        }
        return back()->withErrors("Something went wrong");
    }


    public function orderapproval(Request $request)
    {

        $user = Auth::user();
        $role = $user->roles[0]->name;

        if ($orderRemark=$this->orderService->OrderApproval($request))
        {
            if ($role=='admin')
                $status=$request->get('admin_approval');
            elseif($role=='salesmanager')
                $status=$request->get('salesmanager_approval');
            else
                $status=$request->get('marketing_approval');

            $orderApprovalRemark = [
                'user_id' => Auth::user()->id,
                'order_approval_id' => $orderRemark->id,
                'remark'=>$request->get('approval_remark'),
                'status'=>$status


            ];
            $this->orderApprovalRemark($orderApprovalRemark);

            return back()->withSuccess("Order Approval created by ".$role);
        }



       back()->withErrors("Something went wrong");


    }

    public function orderapprovalupdate(Request $request,$id)
    {

        $user = Auth::user();
        $role = $user->roles[0]->name;
        if ($orderRemark=$this->orderService->OrderApprovalUpdate($request,$id))
        {
            if ($role=='admin' || $role=='generalmanager'|| $role=='director')
                $status=$request->get('admin_approval');
            elseif($role=='salesmanager')
                $status=$request->get('salesmanager_approval');
            else
                $status=$request->get('marketing_approval');

            $orderApprovalRemark = [
                'user_id' => Auth::user()->id,
                'order_approval_id' => $orderRemark->id,
                'remark'=>$request->get('approval_remark'),
                'status'=>$status


            ];
            $this->orderApprovalRemark($orderApprovalRemark);

            return back()->withSuccess("Order Approval created by ".$role);
        }

        return back()->withErrors("Something went wrong");


    }

    public function orderOut(Request $request)
    {
       $orderId=$request->order_id;
        if ($this->orderService->orderout($request)) {
            return redirect()->route('order.show',compact('orderId'))->withSuccess("Order send to the warehouse!");
        }
        return back()->withErrors("Something went wrong");
    }

    public function orderdispatch(Request $request)
    {
        if ($this->orderService->orderDispatch($request)) {
            return back()->withSuccess("Order Dispatched to the Customer!");
        }
        return back()->withErrors("Something went wrong");

    }


    public function salesAdminApproval(Request $request)
    {
        $user = Auth::user();
        $role = $user->roles[0]->name;
        $formData = $request->all();
        if ($orderApproval=$this->orderService->updateAdminOrder($formData,$role))
        {
            $orderAppId = $this->orderService->getOrderApproval($formData['order_id']);
            if ($role=='admin' || $role=='generalmanager'|| $role=='director' )
                $status=$request->get('admin_approval');
            elseif($role=='salesmanager')
                    $status=$request->get('sales_approval');
            else
                    $status=$request->get('marketing_approval');
            $orderApprovalRemark = [
                'user_id' => Auth::user()->id,
                'order_approval_id' => $orderAppId->id,
                'remark'=>$request->get('approval_remark'),
                'status'=>$status


            ];
            $this->orderApprovalRemark($orderApprovalRemark);

            return back()->withSuccess("Order Approval created by ".$role);
        }

        return back()->withErrors("Something went wrong");
    }
    protected function orderApprovalRemark(array $data)
    {
        return OrderApprovalRemarks::create($data);
    }

}


