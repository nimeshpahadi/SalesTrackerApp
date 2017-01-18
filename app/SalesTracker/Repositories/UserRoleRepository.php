<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/11/16
 * Time: 4:51 AM
 */

namespace App\SalesTracker\Repositories;


use App\FactoryinchargeWarehouse;
use App\Role;
use App\Roleuser;
use App\SalesTracker\Entities\Inventory\Warehouse;
use App\User;
use Illuminate\Contracts\Logging\Log;
use League\Flysystem\Exception;

class UserRoleRepository
{
    /**
     * @var User
     */
    public $user;
    /**
     * @var Roleuser
     */
    public $roleuser;
    /**
     * @var Role
     */
    public $role;
    /**
     * @var Log
     */
    private $log;
    /**
     * @var FactoryinchargeWarehouse
     */
    private $factoryinchargeWarehouse;

    /**
     * UserRoleRepository constructor.
     * @param User $user
     * @param Roleuser $roleuser
     * @param Role $role
     */
    public function __construct(User $user, Roleuser $roleuser, Role $role, Log $log, FactoryinchargeWarehouse $factoryinchargeWarehouse)
    {

        $this->user = $user;
        $this->roleuser = $roleuser;
        $this->role = $role;
        $this->log = $log;
        $this->factoryinchargeWarehouse = $factoryinchargeWarehouse;
    }

    /**
     * Return users and its role.
     * @return mixed
     */
    public function getUserRoles()
    {

        $query = $this->user->select('users.username as user_name', 'users.reportsto', 'roles.name as role_name', 'roles.display_name as display_name', 'users.id as user_id', 'roles.id as roles_id')
            ->join('role_user', 'users.id', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', 'roles.id')
            ->orderBy('display_name')
            ->get();

        return $query;
    }

    public function getReportsToRepo($id)
    {

        $query = $this->user->select('roles.display_name','roles.id as role_id')
                            ->join('roles', 'roles.id', 'users.reportsto')
                            ->where('users.id', $id);

        return $query->first();
    }

    public function getUserRolesid($id)
    {

        $query = $this->user->select('users.username as user_name', 'roles.name as role_name', 'users.reportsto', 'users.id as user_id', 'roles.id as roles_id')
            ->join('role_user', 'users.id', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', 'roles.id')
            ->where('users.id', $id);

        return $query->first($id);
    }

    /**
     * get all the role name available
     * @return mixed
     */
    public function getAllRoles()
    {
        $query = $this->role->select('*')->orderBy('display_name');
        return $query->get();
    }

    /**
     * stores the new roles
     * @param $request
     */
    public function storesRole($request)
    {
        try {
            $query = new Role();
            $query->name = $request->name;
            $query->description = $request->description;
            $query->display_name = $request->display_name;
            $query->save();
            $this->log->info("Role Created");

            return true;
        } catch (Exception $e) {
            $this->log->error("Role Creation Failed");

            return false;

        }

    }

    public function assignrolesforuser($data)
    {
        try {
            $roles = $this->roleuser;
            $roles->role_id = $data['role_id'];
            $roles->user_id = $data['user_id'];
            $roles->save();

//            return $roles;
            $this->log->info("Role Assigned for User");

            return true;
        } catch (Exception $e) {
            $this->log->error("Role Assign Failed");

            return false;

        }

    }

    public function updaterolesforuser($request, $user_id)
    {
        try {
            $query = $this->roleuser->find($user_id);
            $query->role_id = $request->role_id;
            $query->user_id = $request->user_id;
            $query->save();

            $this->log->info("Role Assign for User Updated");

            return true;
        } catch (Exception $e) {
            $this->log->error("Role Assign Update Failed");

            return false;

        }
    }

    public function selectuserRole($user_id)
    {
        $query = $this->roleuser->find($user_id);
        return $query;
    }

    public function getWarehouseforFactory($id)
    {
        $query = $this->factoryinchargeWarehouse->select('warehouses.name as warehousename','warehouses.id as warehouse_id')
            ->join('users', 'users.id', 'factoryincharge_warehouses.user_id')
            ->join('warehouses', 'warehouses.id', 'factoryincharge_warehouses.warehouse_id')
            ->where('users.id', $id);
//dd($query->toSql());
        return $query->first();
    }


}









