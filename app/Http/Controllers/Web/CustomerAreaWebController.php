<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/9/17
 * Time: 1:33 PM
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Web\CustomerAreaWebService;
use Illuminate\Http\Request;

class CustomerAreaWebController extends Controller
{
    /**
     * @var CustomerAreaWebService
     */
    private $areaWebService;

    /**
     * CustomerAreaWebController constructor.
     * @param CustomerAreaWebService $areaWebService
     */
    public function __construct(CustomerAreaWebService $areaWebService)
    {
        $this->areaWebService = $areaWebService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('distributor/customer_area');
    }

    /**
     * @param Request $areaRequest
     * @return $this
     */
    public function store(Request $areaRequest)
    {
        $data = $areaRequest->all();

        if ($this->areaWebService->store($data))
        {
            return redirect('/home')->withSuccess("Customer Area Created Successfully !!!");
        }

        return back()->withErrors("Something Went Wrong");
    }
}