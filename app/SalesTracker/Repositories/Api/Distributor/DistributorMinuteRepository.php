<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/7/16
 * Time: 11:33 AM
 */

namespace App\SalesTracker\Repositories\Api\Distributor;


use App\SalesTracker\Entities\Distributor\DistributorMinute;

class DistributorMinuteRepository
{
    /**
     * @var DistributorMinute
     */
    private $distributorMinute;

    /**
     * DistributorMinuteRepository constructor.
     * @param DistributorMinute $distributorMinute
     */
    public function __construct(DistributorMinute $distributorMinute)
    {
        $this->distributorMinute = $distributorMinute;
    }

    /**
     * @param $minute
     * @return static
     */
    public function createMinuteRepo($minute)
    {
        return $this->distributorMinute->create($minute);
    }
}