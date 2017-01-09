<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/11/16
 * Time: 4:49 AM
 */

namespace App\SalesTracker\Services;


use App\SalesTracker\Repositories\UserRepository;
use Illuminate\Http\Request;


class UserService
{

    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * get all users
     * @return mixed
     */
    public function getUsers()
    {
        $users = $this->userRepository->getUser();

        return $users;

    }

    /**
     * @return mixed
     */
    public function selectUsers($id)
    {
        $userbyid = $this->userRepository->selectUser($id);
        return $userbyid;
    }

//    public function storeuser( $request)
//    {
//
//        $storeuser =$this->userRepository->storesuser($request);
//        return $storeuser;
//    }

    public function updateUser($request, $id)
    {

        $userupdate = $this->userRepository->updateUser($request, $id);
        return $userupdate;
    }

    public function deleteUser($id)
    {
        $userdelete = $this->userRepository->deleteUserId($id);
        return $userdelete;
    }

    public function changePassword( $request,$id)
    {
        $data = $this->userRepository->ChangePassword($request,$id);
        return $data;
    }

    public function resetPassword($request, $id)
    {
        $data = $this->userRepository->ResetPassword($request,$id);
        return $data;
    }
}



