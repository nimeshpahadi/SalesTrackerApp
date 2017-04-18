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
    public function index()
    {
        $customerAreaList = $this->areaWebService->getCustomerAreaList();
        return view('distributor/customer_area_index', compact('customerAreaList'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('distributor/customer_area_create');
    }

    /**
     * @param Request $areaRequest
     * @return $this
     */
    public function store(Request $areaRequest)
    {
        if ($this->areaWebService->store($areaRequest))
        {
            return redirect()->route('area.index')->withSuccess("Customer Area Created Successfully !!!");
        }

        return back()->withErrors("Something Went Wrong");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $customerAreaId = $this->areaWebService->getId($id);
        $zone = isset($customerAreaId->distributorDetails()->first()->zone)?$customerAreaId->distributorDetails()->first()->zone:'';
        $customerAreaPlaces = $this->areaWebService->getPlaces($id);

        return view('distributor/customer_area_edit', compact('customerAreaId', 'customerAreaPlaces', 'zone'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this
     */
    public function update(Request $request, $id)
    {
        if ($this->areaWebService->update($request, $id))
        {
            return redirect()->route('area.index')->withSuccess("Customer Area Updated Successfully !!!");
        }

        return back()->withErrors('Something Went Wrong');
    }

    /**
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        if ($this->areaWebService->destroy($id))
        {
            return redirect()->route('area.index')->withSuccess('Customer Area Deleted');
        }

        return back()->withErrors('Something Went Wrong');
    }
}