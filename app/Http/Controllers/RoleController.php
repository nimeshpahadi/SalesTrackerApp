<?php

namespace App\Http\Controllers;

use App\Role;
use App\Roleuser;
use App\SalesTracker\Services\UserRoleService;
use App\SalesTracker\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use League\Flysystem\Exception;


class RoleController extends Controller
{
    /**
     * @var UserRoleService
     */
    public $roleService;
    /**
     * @var UserService
     */
    private $userService;

    /**
     * RoleController constructor.
     * @param UserRoleService $roleService
     * @param UserService $userService
     */
    public function __construct(UserRoleService $roleService, UserService $userService)
    {
        $this->middleware('role:admin|director|generalmanager');
        $this->roleService = $roleService;
        $this->userService = $userService;
    }

    public function index()
    {

        $user = $this->userService->getUsers();
        $allrole = $this->roleService->getallrole();
        $userRoles = $this->roleService->getUsersRole();
        return view('role.index', compact('user', 'allrole', 'userRoles'));
    }


    public function create()
    {
        return view('role/create');
    }


    public function store(Request $request)
    {
        $request->all();
        $this->roleService->storerole($request);
        $request->session()->flash('alert-success', 'role was created successfully!');
        return redirect()->route('role.index');
    }

    public function assignrole(Request $request)
    {
        if ($this->roleService->assignroles($request)) {
            return back()->withInput();
        }

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $allrole = $this->roleService->getallrole();
        $user = $this->userService->selectUsers($id);
        $userRoles = $this->roleService->getUsersRole();
        return view('role.edit', compact('user', 'allrole', 'userRoles'));
    }

    public function update(Request $request, $id)
    {
        $request->all();
        $user = $this->roleService->selectuserrole($id);
        $allrole = $this->roleService->getallrole();
        $this->roleService->updateUserRoles($request, $id);
        $request->session()->flash('alert-success', 'role for user was edited successfully!');
        return redirect()->route('role.index', compact('user', 'allrole', 'userRoles'));

    }

    public function destroy($id)
    {
//
    }

}
