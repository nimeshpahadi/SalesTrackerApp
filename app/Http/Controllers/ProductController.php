<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\SalesTracker\Entities\Inventory\Warehouse_Product;
use App\SalesTracker\Entities\Product\Product;
use App\SalesTracker\Services\productService;
use App\SalesTracker\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\String_;


class ProductController extends Controller
{
    /**
     * @var productService
     */
    public $productService;
    /**
     * @var stockService
     */
    private $stockService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(productService $productService,stockService $stockService)
    {
        $this->middleware(['auth']);
        $this->productService = $productService;
        $this->stockService = $stockService;
    }

    public function index()
    {
        $data = Product::all();
        return view('product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $ware = $this->stockService->get_allwarehouse();
        return view('product.create',compact('ware'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if ($product=$this->productService->storeproduct($request))
        {
            $ware=$request['warehouse_id'];
            foreach ($ware as $w) {
                $productwarehouse = [
                    'product_id' => $product->id,
                    'warehouse_id' => $w
                ];
                $this->assignwarehouse($productwarehouse);
            }
            return redirect('/product')->withSuccess('Product Added');
        }
        return back()->withErrors('something went wrong');
    }

    protected function assignwarehouse(array $data)
    {
        return Warehouse_Product::create($data);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ware = $this->stockService->get_allwarehouse();
        $product = Product::find($id);
        return view('product.edit', compact('product','ware'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {


        if ($product = $this->productService->editproduct($request, $id)) {
            $ware = $request['warehouse_id'];
            foreach ($ware as $w) {
                $productwarehouse = [
                    'product_id' => $id,
                    'warehouse_id' => $w
                ];
                $this->assignupdatewarehouse($productwarehouse);
            }
            return redirect('/product')->withSuccess('Product edited');
        }
        return back()->withErrors('something went wrong');
    }

        protected function assignupdatewarehouse(array $data)
    {
        return Warehouse_Product::create($data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ($this->productService->deleteproduct($id)) {
            return redirect('/product')->withSuccess('Product Deleted');
        }
        return back()->withErrors('something went wrong');

    }

    public function updateprice(Request $request, $id)
    {

        if ($this->productService->changeprice($request, $id)) {
            return redirect('product')->withSuccess('Price Changed');
        }
        return back()->withErrors('something went  wrong');
    }
}


















