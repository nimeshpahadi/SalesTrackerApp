<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/24/16
 * Time: 2:49 PM
 */

namespace App\SalesTracker\Repositories\Api\Distributor;


use App\SalesTracker\Entities\Distributor\DistributorTracking;

class DistributorTrackingRepository
{
    /**
     * @var DistributorTracking
     */
    public $distributorTracking;

    /**
     * DistributorTrackingRepository constructor.
     * @param DistributorTracking $distributorTracking
     */
    public function __construct(DistributorTracking $distributorTracking)
    {
        $this->distributorTracking = $distributorTracking;
    }

    /**
     * @param $repoTrack
     * @return mixed
     */
    public function insertTrack($repoTrack)
    {
        $query = $this->distributorTracking->create($repoTrack);

        return $query;
    }
}