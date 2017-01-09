<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/7/16
 * Time: 11:32 AM
 */

namespace App\SalesTracker\Services\Api\Distributor;


use App\SalesTracker\Repositories\Api\BaseRepository;
use App\SalesTracker\Repositories\Api\Distributor\DistributorMinuteRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;
use App\SalesTracker\Services\Api\BaseService;

class DistributorMinuteService extends BaseService
{
    /**
     * @var DistributorMinuteRepository
     */
    private $minuteRepository;
    /**
     * @var UserApiRepository
     */
    private $apiRepository;
    /**
     * @var BaseRepository
     */
    private $baseRepository;

    /**
     * DistributorMinuteService constructor.
     * @param DistributorMinuteRepository $minuteRepository
     * @param UserApiRepository $apiRepository
     * @param BaseRepository $baseRepository
     */
    public function __construct(DistributorMinuteRepository $minuteRepository, UserApiRepository $apiRepository,
                                BaseRepository $baseRepository)
    {
        $this->minuteRepository = $minuteRepository;
        $this->apiRepository    = $apiRepository;
        $this->baseRepository   = $baseRepository;
    }

    /**
     * @param $serviceMinute
     * @return array
     */
    public function createMinuteService($serviceMinute)
    {
        if (!$this->validateToken($this->apiRepository, $serviceMinute['api_token'])) {

            return $this->tokenMessage();
        }

        $this->storeData($this->baseRepository, $serviceMinute);

        $minute = [

            "user_id"        => $serviceMinute['user_id'],
            "distributor_id" => $serviceMinute['distributor_id'],
            "report"         => $serviceMinute['report'],
            "latitude"       => $serviceMinute['latitude'],
            "longitude"      => $serviceMinute['longitude']

        ];

        if ($this->minuteRepository->createMinuteRepo($minute)) {

            $resp = [

                "status"       => "true",
                "token_status" => "true",
                "message"      => "distributor minute created"

            ];

            return $resp;
        }

        $respo = [

            "status"       => "false",
            "token_status" => "true",
            "message"      => "oops !!! something went wrong"

        ];

        return $respo;
    }
}