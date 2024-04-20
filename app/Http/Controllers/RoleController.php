<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::query()->get();
        return view('role.index', [
            'roles'=>$roles
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
        Role::query()->create($request->validated());
        return redirect()->route('roles.index')
            ->with('success', 'Add role successful!');
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
        $role = Role::query()->find($roleId);
        return view('role.edit', [
            'role'=>$role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoleRequest $request, $roleId)
    {
        $role = Role::query()->find($roleId);
        $role->update($request->validated());
        return redirect()->route('roles.index')
            ->with('success', 'Update role successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
