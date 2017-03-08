<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\SalesTracker\Entities\Order\Order_out;
use App\SalesTracker\Entities\Order\OrderApprovalRemarks;
use App\SalesTracker\Services\DistributorService;
use App\SalesTracker\Services\OrderService;
use App\SalesTracker\Services\StockService;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

    public function __construct( OrderService $orderService, DistributorService $distributorService,
                                 StockService $stockService,OrderApprovalRemarks $orderApprovalRemarks)
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



        $user=Auth::user();
        $userInfo=[
            "id"=>$user->id,
            "role"=>$user->roles[0]->name
        ];
        $stocks = $this->stockService->getStocks($userInfo);

        return view('order.show',compact('order','orderId','order_payment','shipaddress',
                                        'approvalremark','dispatched','order_billings','orderout',
                                        'ware','order_approval','salesapproval','adminapproval',
                                        'marketingapproval','stocks'));

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
        $distId= $this->orderService->getDistributororder($id);
        $orderId= $this->orderService->getorderbyid($id);

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
            return redirect()->route('distributor.show', compact('distributorid'))
                            ->withSuccess(" Payment created success");
        }

        return back()->withErrors("Something went wrong");
    }


    public function orderapproval(Request $request)
    {
        $user = Auth::user();
        $role = $user->roles[0]->name;

        if ($orderRemark=$this->orderService->OrderApproval($request))
        {
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


    protected function orderApprovalRemark(array $data)
    {
        return OrderApprovalRemarks::create($data);
    }

    public function getPdf($id)
    {
        $order_billings=$this->orderService->getcountorderBilling($id);
        $orderId= $this->orderService->getorderbyid($id);
        $shipaddress=$this->distributorService->shippingAddress($orderId->distributor_id);


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('partials.pdf',compact('order_billings','orderId','shipaddress'));
        return  ($pdf->stream());
    }

    public function smscreate($id)
    {

        $orderId= $this->orderService->getorderbyid($id);
        $distId= $this->orderService->getDistributororder($orderId->distributor_id);
        $dispatched = $this->stockService->getstockoutbyorder($id);
        $shipaddress = $this->distributorService->shippingAddress($orderId->distributor_id);
        $billingaddress = $this->distributorService->billingAddress($orderId->distributor_id);



        return view('order.createsms',compact('distId','orderId','id','dispatched','shipaddress','billingaddress'));

    }
    public function sms(Request $request)
    {
        try {

            $orderId = $request->order_id;
            $args =
                http_build_query(array(
                    'token' => env('SPARROW_TOKEN'),
                    'from'  => 'Demo',
                    'to'    =>  trim($request->send_to).',',
                    'text'  =>  $request->sms));
            $url = "http://api.sparrowsms.com/v2/sms/";

//dd($args);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
//            dd($response);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return redirect()->route('order.show',compact('orderId'))->withSuccess("sms was send to the customer!");

        } catch (Exception $e) {

            return back()->withErrors('sms was not send to the customer!');
        }



    }
}
