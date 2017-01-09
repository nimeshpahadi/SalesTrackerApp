<?php

namespace App\SalesTracker\Repositories\Api\User;

use App\User;
use Illuminate\Support\Facades\DB;

class UserApiRepository
{

    /**
     * @var User
     */
    public $user;

    /**
     * UserApiRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param $userId
     * @param $token
     * @param $date
     * @param $expired
     */
    public function insertData($userId, $token, $date, $expired)
    {
        DB::table('user_track')->insert([
            'user_id' => $userId,
            'token' => $token,
            'loggedin_date' => $date,
            'expired_date' => $expired
        ]);
    }

    /**
     * @param $token
     * @return mixed
     */
    public function getLoggedInData($token)
    {
        $query = DB::table('user_track')->where('token', '=', $token);

        return $query->get()->toArray();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUserId($id)
    {
        $data = $this->user->select('users.*', 'roles.display_name')
                           ->join('roles', 'roles.id', 'users.reportsto')
                           ->where('users.id', $id);

        if (is_null($data))
        {
            return null;
        }

        return $data->get()->toArray();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getUser($data)
    {
        $query = User::where('email', $data['email']);

        if (is_null($query))
        {
            return null;
        }

        return $query->first();
    }
}