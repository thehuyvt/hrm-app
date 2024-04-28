<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Project;

class ProjectRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Project();
    }

    public function getAll()
    {
        return $this->model::query()->with('people')->get();
    }
    public function findAll()
    {
        return $this->model::query()->with('people')->paginate(10);
    }

    public function save($request)
    {
        return $this->model::query()->create($request->validated());
    }

    public function update($request, $id)
    {
        return $this->findById($id)->update($request->validated());
    }

    public function delete($id)
    {
        $this->model::destroy($id);
    }

    public function findById($id)
    {
        return $this->model::query()->where('code', $id)->first();
    }
}
