<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\User;
use App\Response\ResponseObject;
use Illuminate\Support\Facades\DB;

class DepartmentRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Department();
    }
    public function findAll()
    {
        return $this->model::query()->paginate(10);
    }

    public function save($request)
    {
        return $this->model::query()->create([
            'code' => $request->code,
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'company_id' => $request->company_id,
        ]);
    }

    public function update($request, $id)
    {
        return DB::table('departments')->where('code', $id)->update($request->validated());
    }

    public function delete($id)
    {
        return $this->model::destroy($id);
    }

    public function findById($id)
    {
        return $this->model::query()->where('code', $id)->first();
    }

    public function findAllExcept($code)
    {
        return $this->model::query()->where('code', '!=', $code)->get();
    }

    public function findAllDepartmentByCompany($companyId)
    {
        $departments = $this->model::query()->where('company_id', $companyId)->get();
        return $this->model::tree($departments);
    }
}
