<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Task();
    }

    public function getAllWithFilterAndSearch($request)
    {
        $tasks = $this->model::query();
        if (!empty($request->company)) {
            $tasks = $tasks->join('projects', 'tasks.project_id', '=', 'projects.code')
                ->where('projects.company_id', $request->company);
         }
        if (!empty($request->project)) {
            $tasks = $tasks->where('project_id', $request->project);
        }
        if (!empty($request->status)) {
            $tasks = $tasks->where('status', $request->status);
        }
        if (!empty($request->priority)) {
            $tasks = $tasks->where('priority', $request->priority);
        }
        if (!empty($request->name)){
            $tasks = $tasks->where('name','like', '%'.$request->name.'%');
        }
        $tasks = $tasks->paginate(10);
//        dd($tasks);
        return $tasks;
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
        return $this->model::find($id)->update($request->validated());
    }

    public function delete($id)
    {
        $this->model::destroy($id);
    }

    public function findById($id)
    {
        return $this->model::find($id);
    }
}
