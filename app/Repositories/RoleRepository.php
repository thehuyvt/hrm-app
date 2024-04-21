<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Role();
    }
    public function findAll()
    {
        return $this->model::query()->get();
    }

    public function save($request)
    {
        return $this->model::query()->create($request->validated());
    }

    public function update($request, $id)
    {
        $role = $this->findById($id);
        $role->update($request->validated());
        return $role;
    }

    public function delete($id)
    {
        $this->model::destroy($id);
    }

    public function findById($id)
    {
        return $this->model::query()->find($id);
    }
}
