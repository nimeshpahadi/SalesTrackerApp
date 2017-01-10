<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/11/16
 * Time: 4:49 AM
 */

namespace App\SalesTracker\Services;


use App\SalesTracker\Repositories\UserRoleRepository;

class UserRoleService
{
    /**
     * @var UserRoleRepository
     */
    public $roleRepository;

    /**
     * UserRoleService constructor.
     * @param UserRoleRepository $roleRepository
     */
    public function __construct(UserRoleRepository $roleRepository)
    {

        $this->roleRepository = $roleRepository;
    }

    public function getUsersRole()
    {
        $roles = $this->roleRepository->getUserRoles();

        return $roles;

    }

    public function getReportsto($id)
    {
        $roles = $this->roleRepository->getReportsToRepo($id);

        return $roles;

    }

    public function getUsersRoleId($id)
    {
        $roles = $this->roleRepository->getUserRolesid($id);

        return $roles;

    }

    public function getallrole()
    {
        $role = $this->roleRepository->getAllRoles();
        return $role;
    }

    public function storerole($request)
    {
        $storerole = $this->roleRepository->storesRole($request);
        return $storerole;
    }

    public function assignroles($request)
    {
        $data = [
            "user_id" => (int)$request->user_id,
            "role_id" => (int)$request->role_id
        ];

        $roleforuser = $this->roleRepository->assignrolesforuser($data);
        return $roleforuser;
    }

    public function updateUserRoles($request, $user_id)
    {
        $updateuserrole = $this->roleRepository->updaterolesforuser($request, $user_id);
        return $updateuserrole;
    }

    /**
     * @return UserRoleRepository
     */
    public function selectuserrole($user_id)
    {
        $userroles = $this->roleRepository->selectuserRole($user_id);
        return $userroles;
    }

    public function getwarehouseforfactory($id)
    {
        $factware = $this->roleRepository->getWarehouseforFactory($id);
        return $factware;
    }


}












