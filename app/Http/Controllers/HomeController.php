<?php

namespace App\Http\Controllers;

use App\SalesTracker\Entities\User\UserLocation;
use App\SalesTracker\Services\OrderService;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(OrderService $orderService)
    {
        $this->middleware('auth');
        $this->orderService = $orderService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $today_order    = $this->orderService->getTotalOrderToday();
        $billing_amount = $this->orderService->billingAmount();
        $paying_amount  = $this->orderService->payingAmount();



        $locations = DB::table('user_locations')
                            ->join('users', 'user_locations.user_id', '=', 'users.id')
                            ->select('users.fullname', 'user_locations.latitude', 'user_locations.longitude')
                            ->whereDate('user_locations.created_at', date('Y-m-d'))
                            ->get();

        $users = [];

        foreach ($locations as $loc) {

            array_push($users,$loc->fullname);
        }

        $users = array_unique($users);

        return view('index',compact('today_order', 'locations',
                                    'billing_amount', 'paying_amount', 'users'));
    }
}