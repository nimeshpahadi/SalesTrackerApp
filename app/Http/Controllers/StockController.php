<?php

namespace App\Http\Controllers;

use App\SalesTracker\Entities\Inventory\Warehouse_Product;
use App\SalesTracker\Services\OrderService;
use App\SalesTracker\Services\productService;
use App\SalesTracker\Services\StockService;
use App\SalesTracker\Services\UserService;
use App\SalesTracker\Services\WarehouseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{

    public $userService;
    public $productService;
    public $stockService;
    public $warehouseService;
    /**
     * @var OrderService
     */
    private $orderService;


    /**
     * StockController constructor.
     * @param UserService $userService
     * @param productService $productService
     * @internal param UserRoleService $roleService
     */
    public function __construct(productService $productService, UserService $userService, OrderService $orderService,
                                StockService $stockService, WarehouseService $warehouseService)
    {
        $this->middleware(['role:factoryincharge|admin|salesmanager|director|generalmanager|accountmanagersales']);
        $this->productService = $productService;
        $this->userService = $userService;
        $this->stockService = $stockService;
        $this->warehouseService = $warehouseService;
        $this->orderService = $orderService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $userInfo=[
            "id"=>$user->id,
            "role"=>$user->roles[0]->name
        ];
                $stockOut= $this->stockService->getstockout();
                $ware = $this->stockService->get_allwarehouse();
                $ware_stock = $this->stockService->get_warehousestock();

                $stocks = $this->stockService->getStocks($userInfo);

                return view("inventory.index", compact('ware', 'ware_stock','orderoutabu','stockOut','stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ware = $this->stockService->get_allwarehouse();

        $user = $this->userService->getUsers();
        $subcat = $this->productService->subcat_list();
        return view("inventory.stock.create", compact('user', 'ware', 'subcat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($this->stockService->store_stock_in($request)) {
            return redirect()->route('stock.index')->withSuccess("stock added!");
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
        //
    }

    public function stockin()
    {
        $ware_name = $this->stockService->get_warehousename();
        return view("inventory.stock.index", compact('ware_name'));
    }

    public function stockout()
    {
        $stockout = $this->stockService->getAllStockout();
        return view("inventory.stock.stockout", compact('stockout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stockin = $this->stockService->getstockID($id);
        $ware_name = $this->stockService->getstockdetail($id);
        $ware_prod = $this->warehouseService->warehouse_product();
        $warehouse = $this->stockService->allwarehouse();
        $product = $this->productService->allproduct();

        return view("inventory.stock.edit", compact('stockin', 'product', 'warehouse', 'ware_prod', 'ware_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->stockService->update_stock($request, $id)) {
            return redirect()->route('stockin')->withSuccess("stock edited!");
        }

        return back()->withErrors("Something went wrong");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }



    public function stockinWarehouse($pid, $wid)
    {
        $ware_name = $this->stockService->getStockhistory($pid, $wid);
        return view("inventory.stock.indexstockin", compact('ware_name'));
    }
    public function stockoutWarehouse($pid, $wid)
    {
        $ware_name = $this->stockService->getStockouthistory($pid, $wid);
        return view("inventory.stock.indexstockout", compact('ware_name'));
    }

    public function orderwarehouse($id)
    {
//        $dispatched=$this->stockService->getstockoutbyorder();
        $ware_order = $this->stockService->getorderwarehouse($id);
        return view("inventory.orders", compact('ware_order','dispatched'));
    }

}
