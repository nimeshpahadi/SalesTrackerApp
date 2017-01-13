<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/24/16
 * Time: 2:48 PM
 */

namespace App\SalesTracker\Services\Api\Distributor;


use App\SalesTracker\Repositories\Api\BaseRepository;
use App\SalesTracker\Repositories\Api\Distributor\DistributorTrackingRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;
use App\SalesTracker\Services\Api\BaseService;

class DistributorTrackingService extends BaseService
{
    /**
     * @var DistributorTrackingRepository
     */
    public $trackingRepository;
    /**
     * @var UserApiRepository
     */
    public $apiRepository;
    /**
     * @var BaseRepository
     */
    private $baseRepository;

    /**
     * DistributorTrackingService constructor.
     * @param DistributorTrackingRepository $trackingRepository
     * @param UserApiRepository $apiRepository
     * @param BaseRepository $baseRepository
     */
    public function __construct(DistributorTrackingRepository $trackingRepository, UserApiRepository $apiRepository,
                                BaseRepository $baseRepository)
    {
        $this->trackingRepository = $trackingRepository;
        $this->apiRepository      = $apiRepository;
        $this->baseRepository     = $baseRepository;
    }

    /**
     * @param $serviceTrack
     * @return array
     */
    public function createTrackingService($serviceTrack)
    {
        if (!$this->validateToken($this->apiRepository, $serviceTrack['api_token'])) {

            return $this->tokenMessage();
        }

        $this->storeData($this->baseRepository, $serviceTrack);

        $trackData = [

            "distributor_id"       => $serviceTrack['distributor_id'],
            "stage"                => $serviceTrack['stage'],
            "business_probability" => $serviceTrack['business_probability'],
            "activity"             => $serviceTrack['activity'],
            "loss_reason"          => $serviceTrack['loss_reason'],
            "latitude"             => $serviceTrack['latitude'],
            "longitude"            => $serviceTrack['longitude'],
            "user_id"              => $serviceTrack['user_id'],
            "remark"               => $serviceTrack['remark'],

        ];

        if ($this->trackingRepository->insertTrack($trackData)) {

            $resp = [

                "status"       => "true",
                "token_status" => "true",
                "message"      => "distributor tracking created"

            ];

            return $resp;
        }

        $respo = [

            "status"       => "false",
            "token_status" => "true",
            "message"      => "oops something went wrong"

        ];

        return $respo;
    }
}