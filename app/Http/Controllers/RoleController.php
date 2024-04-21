<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private RoleService $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService();
    }
    public function index()
    {
        $response = $this->roleService->getAll();
        return view('role.index', [
            'roles'=>$response->getData()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $response = $this->roleService->save($request);
        return redirect()->route('roles.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($roleId)
    {
        $response = $this->roleService->getById($roleId);
        return view('role.edit', [
            'role'=>$response->getData(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoleRequest $request, $roleId)
    {
        $response = $this->roleService->update($request, $roleId);
        return redirect()->route('roles.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        $response = $this->roleService->delete($roleId);
        return redirect()->route('roles.index')
            ->with($response->getStatus(), $response->getMessage());
    }
}
