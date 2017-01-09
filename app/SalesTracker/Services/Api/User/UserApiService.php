<?php

namespace App\SalesTracker\Services\Api\User;


use App\SalesTracker\Repositories\Api\User\UserApiRepository;
use App\SalesTracker\Services\Api\BaseService;
use Illuminate\Support\Facades\Hash;

class UserApiService extends BaseService
{
    /**
     * @var UserApiRepository
     */
    public $userRepo;

    /**
     * UserApiService constructor.
     * @param UserApiRepository $userRepo
     */
    public function __construct(UserApiRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param $data
     * @return array
     */
    public function login($data)
    {
        $user = $this->userRepo->getUser($data);

        if ($user==null) {

            $query = [

                "status"  => "false",
                "message" => "oops !!! user not valid"

            ];

            return $query;
        }

        $password = Hash::check($data['password'], $user->password);

        if ($password) {

            $date = date('Y/m/d H:i:s');
            $expired = date('Y/m/d H:i:s', strtotime('+24 hours'));
            $token = bcrypt(strtotime($date) + strtotime($expired));
            $userId = $user->id;

            $this->userRepo->insertData($userId, $token, $date, $expired);

            $resp = [

                "status"    => "true",
                "api_token" => $token,
                "id"        => $userId

            ];

            return $resp;
        }

            $respo = [

                "status"  => "false",
                "message" => "oops!!! password not valid."

            ];

        return $respo;
    }

    /**
     * @param $id
     * @param $request
     * @return array
     */
    public function getServiceId($id, $request)
    {
        if (!$this->validateToken($this->userRepo, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $data = $this->userRepo->getUserId($id);


        if ($data==null) {

            $query = [

                "status"       => "false",
                "token_status" => "true",
                "message"      => "User not found"

            ];

            return $query;
        }

        $data = (array)$data[0];

        $dataId                 = [];
        $dataId["status"]       = "true";
        $dataId["token_status"] = "true";

        $dataId['user_details'][] = [

            "id"         => $data['id'],
            "fullname"   => $data['fullname'],
            "username"   => $data['username'],
            "email"      => $data['email'],
            "department" => $data['department'],
            "contact"    => $data['contact'],
            "reportsto"  => $data['display_name']

        ];

        return $dataId;
    }
}