<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/22/16
 * Time: 10:31 AM
 */

namespace App\SalesTracker\Repositories\Api\Distributor;

use App\SalesTracker\Entities\Distributor\DistributorAddress;
use Illuminate\Contracts\Logging\Log;

class DistributorAddressRepository
{
    /**
     * @var DistributorAddress
     */
    public $distributorAddress;
    /**
     * @var Log
     */
    private $log;

    /**
     * DistributorAddressRepository constructor.
     * @param DistributorAddress $distributorAddress
     * @param Log $log
     */
    public function __construct(DistributorAddress $distributorAddress, Log $log)
    {
        $this->distributorAddress = $distributorAddress;
        $this->log = $log;
    }

    /**
     * @param $dist_address
     * @return static
     */
    public function insertAddress($distAddress)
    {
        try {
            $this->distributorAddress->insert($distAddress);
            $this->log->info("Distributor Address Created");
            return true;

        } catch (QueryException $e) {
            $this->log->error("Distributor Address  Creation Failed");
            return false;
        }
    }

}