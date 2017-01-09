<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/18/16
 * Time: 12:43 PM
 */

namespace App\SalesTracker\Services\Api;


class BaseService
{
    /**
     * @param $userAPI
     * @param $token
     * @return bool
     */
    public function validateToken($userAPI, $token)
    {
        $tokenData = $userAPI->getLoggedInData($token);

        if(!empty($tokenData)) {

            $expiredTime = strtotime($tokenData[0]->expired_date);

            $now =strtotime(date('Y/m/d H:i:s'));

            if($now>$expiredTime) {

                return false;
            }
        }

            else {

                return false;
            }

            return true;
    }

    /**
     * @return array
     */
    public function tokenMessage()
    {
        $response =[

            "status"       => "false",
            "token_status" => "false",
            "message"      => "Token invalid."

            ];

        return  $response;
    }

    /**
     * @param $basreRepo
     * @param $data
     */
    public function storeData($basreRepo, $data)
    {
        $data=[

            "data"      => (string)json_encode($data),
            "api_token" => $data['api_token'],

        ];

        $basreRepo->saveData($data);
    }
}