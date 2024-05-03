<?php

namespace App\Services;



use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use App\Http\Requests\StoreCountryRequest;
use App\Models\Country;
use App\Models\Task;
use App\Repositories\CompanyRepository;
use App\Repositories\CountryRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\RoleRepository;
use App\Repositories\TaskRepository;
use App\Response\ResponseObject;
use Barryvdh\DomPDF\Facade\Pdf;

class TaskService
{
    private TaskRepository $taskRepository;
    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }


    public function getAll()
    {
        $tasks = $this->taskRepository->findAll();
        return new ResponseObject('success', "Lấy dự án thành công!", $tasks);
    }

    public function getAllWithFilterAndSearch($request)
    {
        $tasks = $this->taskRepository->getAllWithFilterAndSearch($request);
        return new ResponseObject('success', "Lấy dự án thành công!", $tasks);
    }

    public function getById($id)
    {
        $task =  $this->taskRepository->findById($id);
        return new ResponseObject('success', "Lấy dự án thành công!", $task);
    }

    public function save($request):ResponseObject
    {
        $this->taskRepository->save($request);
        return new ResponseObject('success', 'Thêm nhiệm vụ thành công!', null);
    }

    public function update($request, $id)
    {
        $this->taskRepository->update($request, $id);
        return new ResponseObject('success', 'Sửa thông tin nhiệm vụ thành công!',null);
    }

    public function delete($id)
    {
        $this->taskRepository->delete($id);
        return new ResponseObject('success', 'Xóa nhiệm vụ thành công!', null);
    }

    public function printPdf()
    {
        $tasks = $this->taskRepository->findAll();
        foreach ($tasks as $task){
            $task->status = TaskStatusEnum::getNameStatus($task->status);
            $task->priority = TaskPriorityEnum::getNamePriority($task->priority);
        }
        $data = [
            'title' => 'List Tasks',
            'date' => date('m/d/Y'),
            'tasks' => $tasks,
        ];
        $pdf = PDF::loadView('task.printPdf', $data, utf8_decode('utf-8'));

        return $pdf->download('tasks-lists.pdf');
    }

}
