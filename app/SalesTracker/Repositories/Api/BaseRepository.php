<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/16
 * Time: 11:57 AM
 */

namespace App\SalesTracker\Repositories\Api;


use App\SalesTracker\Entities\ApiLog;

class BaseRepository
{
    /**
     * @var ApiLog
     */
    private $apiLog;

    /**
     * BaseRepository constructor.
     * @param ApiLog $apiLog
     */
    public function __construct(ApiLog $apiLog)
    {
        $this->apiLog = $apiLog;
    }

    /**
     * @param $data
     */
    public function saveData($data)
    {
        $this->apiLog->create($data);
    }
}