<?php

namespace App\Http\Controllers;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Services\CompanyService;
use App\Services\ProjectService;
use App\Services\TaskService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class TaskController extends Controller
{
    private ProjectService $projectService;
    private TaskService $taskService;

    private CompanyService $companyService;

    public function __construct()
    {
        $this->projectService = new ProjectService();
        $this->taskService = new TaskService();
        $this->companyService = new CompanyService();
        $listStatus = TaskStatusEnum::getArrayStatus();
        $listPriorities = TaskPriorityEnum::getArrayPriority();

        View::share('listStatus', $listStatus);
        View::share('listPriorities', $listPriorities);

    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getAllWithFilterAndSearch($request)->getData();
//        $tasks=$this->taskService->getAll()->getData();
//        dd($tasks);
        foreach ($tasks as $task){
            $task->status = TaskStatusEnum::getNameStatus($task->status);
            $task->priority = TaskPriorityEnum::getNamePriority($task->priority);
        }
        $companies = $this->companyService->getAll()->getData();
        foreach ($companies as $company){
            $company->projects;
        }
//        dd($tasks);
        return view('task.index', [
            'tasks' => $tasks,
            'companies' => $companies,
        ]);
    }


    public function create()
    {
        $projects = $this->projectService->listProject();
//        dd($projects[0]);
        return view('task.create', [
            'projects' => $projects,

        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $response = $this->taskService->save($request);
        return redirect()->route('tasks.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    public function edit($id)
    {
        $task = $this->taskService->getById($id)->getData();
//        dd($task);
        $projects = $this->projectService->listProject();

        return view('task.edit', [
            'task' => $task,
            'projects' => $projects,
        ]);
    }

    public function update(StoreTaskRequest $request, $id)
    {
        $response = $this->taskService->update($request, $id);
        return redirect()->route('tasks.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    public function destroy($id)
    {
        $response = $this->taskService->delete($id);
        return redirect()->route('tasks.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    public function printPdf()
    {
        return $this->taskService->printPdf();
    }
}
