<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Services\CompanyService;
use App\Services\RoleService;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;
    private CompanyService $companyService;

    private RoleService $roleService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->companyService = new CompanyService();
        $this->roleService = new RoleService();
    }

    public function index()
    {
        $response = $this->userService->getAll();
        return view('user.index', [
            'users' => $response->getData(),
        ]);
    }

    public function create()
    {
        $companies = $this->companyService->getAll()->getData();
        $roles = $this->roleService->getAll()->getData();
        return view('user.create', [
            'companies' => $companies,
            'roles' => $roles,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $response = $this->userService->save($request);

        return redirect()->route('users.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    public function edit($userId)
    {
        $user = $this->userService->getById($userId)->getData();
//        dd($user);
        $selectedRoles = $user->roles;
//        dd($selectedRoles);
        $companies = $this->companyService->getAll()->getData();
        $roles = $this->roleService->getAll()->getData();
//        dd($roles);
        return view('user.edit', [
            'user' => $user,
            'companies' => $companies,
            'roles' => $roles,
            'selectedRoles' => $selectedRoles,
        ]);
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $response = $this->userService->update($request, $userId);
        return redirect()->route('users.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    public function destroy($userId)
    {
       $response = $this->userService->delete($userId);
        return redirect()->route('users.index')
            ->with($response->getStatus(), $response->getMessage());
    }
}
