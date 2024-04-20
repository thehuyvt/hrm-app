<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {
        $users = $this->model::query()
            ->with('person')
            ->paginate(10);
        dd($users);
        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $companies = Company::query()->get();
        $roles = Role::query()->get();
        return view('user.create', [
            'companies' => $companies,
            'roles' => $roles,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $roles = $request->input('listRoleId');

        $user = User::query()->create([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user->person()->create([
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'company_id' => $request->company_id,
        ]);

        $user->roles()->sync($roles);

        return redirect()->route('users.index');
    }

    public function edit($userId)
    {
        $user = User::query()->find($userId);
        $selectedRoles = $user->roles;
        $companies = Company::query()->get();
        $roles = Role::query()->get();
        return view('user.edit', [
            'user' => $user,
            'companies' => $companies,
            'roles' => $roles,
            'selectedRoles' => $selectedRoles,
        ]);
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $roles = $request->input('listRoleId');
        $user = User::query()->find($userId);
        $user->update([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $user->person()->update([
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
        $user->roles()->sync($roles);
        return redirect()->route('users.index')->with('success', 'Update user successful!');
    }

    public function destroy($userId)
    {
        User::query()->where('id', '=', $userId)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Delete user successful!');
    }
}
