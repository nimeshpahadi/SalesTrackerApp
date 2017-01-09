<?php

namespace App\Http\Controllers;

use App\FactoryinchargeWarehouse;
use App\Http\Requests\RegisterRequest;
use App\Role;
use App\Roleuser;
use App\SalesTracker\Services\StockService;
use App\SalesTracker\Services\UserRoleService;
use App\SalesTracker\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * @var StockService
     */
    private $stockService;
    private $userService;
    private $userRoleService;



    public function __construct(UserService $userService, UserRoleService $userRoleService,StockService $stockService)
    {
        $this->middleware([ 'role:admin|salesmanager|accountmanagersales|generalmanager|director'] );
        $this->userService = $userService;
        $this->userRoleService = $userRoleService;

        $this->stockService = $stockService;
    }

    public function index()
    {
        $user = $this->userService->getUsers();
        $role = $this->userRoleService->getallrole();
        $userRoles = $this->userRoleService->getUsersRole();


        return view('user/index', compact('user', 'role', 'userRoles'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = $this->userRoleService->getallrole();
        $ware = $this->stockService->get_allwarehouse();
        return view('user/register', compact('role','ware'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->selectUsers($id);

        $userRoles = $this->userRoleService->getUsersRole();
        $reportsTo = $this->userRoleService->getReportsto($id);
        return view('user.show', compact('user', 'userRoles', 'reportsTo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = $this->userService->selectUsers($id);
        $role = $this->userRoleService->getallrole();
        $userRoleid = $this->userRoleService->getUsersRoleId($id);
        $reportsTo = $this->userRoleService->getReportsto($id);
        return view('user.edit', compact('user', 'role', 'userRoleid', 'reportsTo'));
    }


    public function update(RegisterRequest $request, $id)
    {

        if (
        $this->userService->updateUser($request, $id)
        ) {
            $userRole = [
                'user_id' => $id,
                'role_id' => $request->get('role')
            ];
            $this->updateRole($userRole);

            if ($request['role']=="factroyincharge")
            {
                $assignWarehouse=[
                    'user_id' => $id,
                    'warehouse_id' => $request->get('warehouse_id')

                ];
                $this->updateassignWarehouse($assignWarehouse);

            }

            return redirect()->route('user.index')->withSuccess('User Edited Successfully');
        }
        return back()->withErrors('User Edited Unsuccess');


    }

    private function updateRole($userRole)
    {
        return Roleuser::where('user_id', $userRole['user_id'])->update(['role_id' => $userRole['role_id']]);

    }

    private function updateassignWarehouse($assignWarehouse)
    {
        return FactoryinchargeWarehouse::where('user_id', $assignWarehouse['user_id'])->update(['warehouse_id' => $assignWarehouse['warehouse_id']]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (
        $this->userService->deleteUser($id)
        ) {
            return redirect()->route('user.index')->withSuccess("User deleted");
        }

        return back()->withErrors("User not deleted");


    }
}