<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistributorDetailRequest;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\GuaranteeRequest;
use App\SalesTracker\Entities\Distributor\DistributorDetails;
use App\SalesTracker\Services\DistributorService;
use App\SalesTracker\Services\OrderService;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    /**
     * @var DistributorService
     */
    public $distributorService;
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(DistributorService $distributorService, OrderService $orderService)
    {
        $this->middleware(['role:admin|account|salesman|salesmanager|factoryincharge|accountmanagersales|generalmanager|director']);
        $this->distributorService = $distributorService;
        $this->orderService = $orderService;
    }

    public function index()
    {

        $distributor = $this->distributorService->distributor_list();
        return view('distributor/index', compact('distributor','nondistributor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('distributor/create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistributorDetailRequest $request)
    {
        if ($this->distributorService->storedistributor($request)) {
            return redirect('/distributor')->withSuccess("Customer created!");
        }
        return back()->withErrors("Something went wrong");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=$this->orderService->getOrderlistdistributor($id);
        $payment=$this->orderService->getDistributorpayment($id);
        $dist = $this->distributorService->select_distributor($id);
        $areaName = isset($dist->customerArea()->first()->area_name)?$dist->customerArea()->first()->area_name:'';
        $address = $this->distributorService->getaddress($id);
        $guarantee = $this->distributorService->getguarantee($id);
        $tracking = $this->distributorService->gettracking($id);
        $minute = $this->distributorService->getMinute($id);

        $billing_transaction = $this->distributorService->getBillingAmount($id);
        $paying_transaction = $this->distributorService->getPayingAmount($id);

        return view('distributor/show', compact('dist', 'address', 'guarantee', 'tracking', 'minute','distributor',
                                                'order', 'payment', 'billing_transaction', 'paying_transaction', 'areaName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dist = $this->distributorService->select_distributor($id);
        $areaName = isset($dist->customerArea()->first()->area_name)?$dist->customerArea()->first()->area_name:'';
        return view('distributor/edit', compact('dist', 'areaName'));
    }


    public function update(Request $request, $id)
    {
        if ($this->distributorService->update_distributor($request, $id)) {
            return redirect()->route('distributor.show', compact('id'))->withSuccess('Customer updated');
        }
        return back()->withErrors('something went wrong');

    }

    public function destroy($id)
    {
        if ($this->distributorService->deleteDistributor($id)) {
            return redirect()->route('distributor.index')->withSuccess('Customer deleted');
        }
        return back()->withErrors('something went wrong');

    }

    public function createguarantee($id)
    {
        $disid = $this->distributorService->select_distributor($id);
        return view('distributor.guarantee', compact('disid'));
    }

    public function guarentee_store(GuaranteeRequest $request)
    {
        $id = $request['distributor_id'];
        if ($this->distributorService->guaranteestore($request)) {
            return redirect()->route('distributor.show', compact('id'))->withSuccess(" Guarantee created success");
        }
        return back()->withErrors("Something went wrong");

    }


    public function createtracking($id)
    {
        $disid = $this->distributorService->select_distributor($id);
        return view('distributor.tracking', compact('disid'));
    }


    public function addTracking(Request $request)
    {
        $this->validate($request, array(
            'stage'                => 'required|max:255',
            'business_probability' => 'required|max:3',
            'activity'             => 'required',
            'loss_reason'          => 'min:5',
            'remark'                =>'min:5',

        ));

        $id = $request['distributor_id'];
        if ($this->distributorService->create_tracking($request)) {
            return redirect()->route('distributor.show', compact('id'))->withSuccess('Visit added success');
        }
        return back()->withErrors('Visit not added, something went wrong');

    }


    /**
     * add minute as per distributor
     * @param Request $request
     * @return $this
     */
    public function storeMinute(Request $request)
    {


        $id = $request['distributor_id'];
        if ($this->distributorService->storeMinute($request)) {
            return redirect()->route('distributor.show', compact('id'))->withSuccess('Minute added success');
        }
        return back()->withErrors('Minute not added, something went wrong');

    }


    /**
     * shows the address view file
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createaddress($id, Request $request)
    {
        $type = $request['type'];
        $disid = $this->distributorService->select_distributor($id);
        return view('distributor.address', compact('disid', 'type'));
    }

    /**
     *store the address to the specific distributor
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addAddress(AddressRequest $request)
    {
        $id = $request['distributor_id'];
        if ($this->distributorService->create_address($request)) {
            return redirect()->route('distributor.show', compact('id'))->withSuccess('Address was added');
        }
        return back(compact('id'))->withErrors('Address was not added');
    }

    public function editaddress($did,$id, Request $request)
    {
        $type = $request['type'];
        $dist = $this->distributorService->select_distributor($did);
        $address = $this->distributorService->getaddress($did);
        $addressbyid = $this->distributorService->getaddressbyid($did,$id);
        return view('distributor/edit_address', compact('dist', 'address','type','addressbyid'));

    }

    public function updateaddress($did,$id,Request $request)
    {
       if( $this->distributorService->update_dis_address( $id,$request)){
          return redirect()->route('distributor.show', compact('did'))->withSuccess('Address was edited');
       }
         return back(compact('did'))->withErrors('Address was not edited');
        }

    public function destroy_address($id)
    {
        $this->distributorService->deleteDistributorAddress($id);
        session()->flash('alert-danger', 'Customer was deleted successfully!');
        return redirect()->route('distributor.index');
    }


    public function editguarantee($id)
    {
        $dist = $this->distributorService->select_distributor($id);
        $guarantee = $this->distributorService->getguarantee($id);

        return view('distributor/edit_guarantee', compact('dist', 'guarantee'));

    }

    public function updateguarantee(Request $request, $id)
    {
        if ($this->distributorService->update_dis_guarantee($request, $id)) {
            return redirect()->route('distributor.show', compact('id'))->withSuccess('guarentee update success');
        }
        return back()->withErrors('Guarantee not edited, something went wrong');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function minuteMap(Request $request)
    {
        $data = $request->all();

        return view('distributor/minute', compact('data'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function visitMap(Request $request)
    {
        $visitData = $request->all();

        return view('distributor/visit', compact('visitData'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCustomerArea(Request $request)
    {
        $customerArea = $this->distributorService->getCustomerArea($request);
        return response()->json($customerArea);
    }
}