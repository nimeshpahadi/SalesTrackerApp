<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/27/16
 * Time: 7:18 PM
 */

namespace App\SalesTracker\Services;


use App\SalesTracker\Repositories\StockRepository;

class StockService
{
    /**
     * @var StockRepository
     */
    public $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function allstock_in()
    {
        $data = $this->stockRepository->getallstockin();
        return $data;
    }

    public function allwarehouse()
    {
        $data = $this->stockRepository->getall_warehouse();
        return $data;
    }


    public function store_stock_in($request)
    {
        $formData = $request->all();
        $formData = array_except($formData, ['_token', 'to', 'remove']);

        $data = $this->stockRepository->storestockin($formData);
        return $data;
    }

    /**
     * get warehouse name and other related stuff
     * @return mixed
     */
    public function get_warehousename()
    {
        $data = $this->stockRepository->get_warehouse_name();
        return $data;
    }

    public function get_warehousestock()
    {
        $data = $this->stockRepository->get_warehouse_stock();
        return $data;
    }

    /* public function getname()
     {
         $data = $this->stockRepository->getwarehouse_name();
         return $data;
     }*/
    public function get_allwarehouse()
    {
        $data = $this->stockRepository->allwarehouse();
        return $data;
    }

    public function getstockdetail($id)
    {
        $data = $this->stockRepository->get_stockdetail($id);
        return $data;
    }

    public function getstockID($id)
    {
        $data = $this->stockRepository->getstockbyid($id);
        return $data;
    }

    public function update_stock($request, $id)
    {
//        $formData = $request->all();
//        $formData = array_except($formData, ['_token', 'to', 'remove']);
        $data = $this->stockRepository->updatestock($request, $id);
        return $data;
    }
//    public function getsum_stocks_in()
//    {
//        $data = $this->stockRepository->getsum_stocksin();
//        return $data;
//    }

    public function getStockhistory($pid, $wid)
    {
        $data = $this->stockRepository->getStockinHistory($pid, $wid);
        return $data;
    }
    public function getStockouthistory($pid, $wid)
    {
        $data = $this->stockRepository->getStockoutHistory($pid, $wid);
        return $data;
    }

    public function getorderwarehouse($id)
    {
        $data = $this->stockRepository->getOrderWarehouse($id);
        return $data;
    }

    public function getstockoutbyorder($id)
    {
        $data = $this->stockRepository->getStockoutbyOrder($id);
        return $data;
    }

    public function getstockout()
    {
        $data = $this->stockRepository->getStockoutqty();
        return $data;
    }

    public function getStocks($userInfo)
    {
        $data = [];
        $wareshouse = $this->stockRepository->getwarehouse($userInfo);

        foreach ($wareshouse as $ware) {
            $getwareproduct = $this->stockRepository->getwareproduct($ware->id);
            $data[$ware->name] = [];
            $data[$ware->name]["ware_id"] =$ware->id ;

            foreach ($getwareproduct as $p) {

                $stockin = $this->stockRepository->getstockin($ware->id,$p->pid);
                $stockout = $this->stockRepository->getstockout($ware->id,$p->pid);
                $data[$ware->name]['product'][$p->sub_category] = [
                    'pid'=>$p->pid,
                    'in' => ($stockin[0]->qty==null)?0:$stockin[0]->qty,
                    'out' => ($stockout[0]->qty==null)?0:$stockout[0]->qty,
                ];

            }

        }

        return $data;

    }

    public function getAllStockout()
    {
        $data = $this->stockRepository->getallstockout();
        return $data;
    }


}













