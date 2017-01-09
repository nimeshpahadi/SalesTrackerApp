<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/29/16
 * Time: 1:53 PM
 */

namespace App\SalesTracker\Repositories\Api\User;

use App\SalesTracker\Entities\User\UserLocation;

class UserLocationRepository
{
    /**
     * @var UserLocation
     */
    private $userLocation;

    /**
     * UserLocationRepository constructor.
     * @param UserLocation $userLocation
     */
    public function __construct(UserLocation $userLocation)
    {
        $this->userLocation = $userLocation;
    }

    /**
     * @param $locationRepo
     * @return static
     */
    public function createLocationRepo($locationRepo)
    {
        return $this->userLocation->create($locationRepo);
    }
}