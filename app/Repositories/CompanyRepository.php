<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Company();
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
        $company = $this->findById($id);
        return $company->update($request->validated());
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
