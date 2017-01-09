<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/27/16
 * Time: 11:16 PM
 */

namespace App\SalesTracker\Services;


use App\SalesTracker\Repositories\WarehouseRepository;

class WarehouseService
{
    /**
     * @var WarehouseRepository
     */
    private $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function warehouse_product()
    {
        $data = $this->warehouseRepository->warehouseproduct();
        return $data;

    }

    public function getwarehouse_name()
    {
        $data = $this->warehouseRepository->get_warehouse_name();
        return $data;
    }


}