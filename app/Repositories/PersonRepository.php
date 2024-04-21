<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Person;
use App\Models\Project;

class PersonRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Person();
    }

    public function findAll()
    {
        return $this->model::query()->paginate(10);
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
