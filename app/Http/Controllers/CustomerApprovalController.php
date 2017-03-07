<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/25/16
 * Time: 1:22 PM
 */

namespace App\Http\Controllers;


use App\SalesTracker\Services\CustomerApprovalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CustomerApprovalController extends Controller
{
    /**
     * @var CustomerApprovalService
     */
    private $approvalService;

    /**
     * CustomerApprovalController constructor.
     * @param CustomerApprovalService $approvalService
     */
    public function __construct(CustomerApprovalService $approvalService)
    {
        $this->approvalService = $approvalService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $customerList = $this->approvalService->customerList();

        return view('distributor/customer_approve_list', compact('customerList'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createSaleApprove(Request $request)
    {
        $this->approvalService->saleManagerApprove($request);

        Session::put('url.intended', URL::previous());

        return Redirect::intended('/')->withSuccess('Customer Approval Updated by Sales manager ');
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accountCustomerList()
    {
        $customerList = $this->approvalService->customerList();

        return view('distributor/accountApproveList', compact('customerList'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateAccountApprove(Request $request)
    {
        $this->approvalService->accountApprove($request);

        Session::put('url.intended', URL::previous());

        return Redirect::intended('/')->withSuccess('Customer Approval Status Updated by Account');
    }
}