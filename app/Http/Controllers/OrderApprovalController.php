<?php

namespace App\Http\Controllers;

use App\SalesTracker\Services\DistributorService;
use App\SalesTracker\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderApprovalController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct( OrderService $orderService,DistributorService $distributorService)
    {
        $this->middleware(['role:admin|salesman|salesmanager|factoryincharge|accountmanagersales|generalmanager|director']);

        $this->orderService = $orderService;
        $this->distributorService = $distributorService;
    }

    public function index()
    {
        $dis=$this->distributorService->distributor_list();
        $orderA = $this->orderService->getOrderApprovalAccount();

        return view('orderApproval.index',compact('orderA','dis'));
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
        //
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
}
