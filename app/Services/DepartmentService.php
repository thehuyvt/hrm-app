<?php

namespace App\Services;



use App\Repositories\DepartmentRepository;
use App\Response\ResponseObject;

class DepartmentService
{
    private DepartmentRepository $departmentRepository;
    public function __construct()
    {
        $this->departmentRepository = new DepartmentRepository();
    }


    public function getAll():ResponseObject
    {
        $departments = $this->departmentRepository->findAll();
        return new ResponseObject('success', "Lấy danh sách các phòng ban thành công!", $departments);
    }

    public function getById($id)
    {
        $department =  $this->departmentRepository->findById($id);
        return new ResponseObject('success', "Lấy phòng ban thành công!", $department);

    }

    public function save($request):ResponseObject
    {
        $department = $this->departmentRepository->save($request);
        return new ResponseObject('success', 'Thêm phòng ban thành công!', $department);
    }

    public function update($request, $id)
    {
        $this->departmentRepository->update($request, $id);
        $department = $this->departmentRepository->findById($id);
        return new ResponseObject('success', 'Sửa thông tin phòng ban thành công!', $department);
    }

    public function delete($id)
    {
        $this->departmentRepository->delete($id);
        return new ResponseObject('success', 'Xóa phòng ban thành công!', null);
    }

    public function getListExcept($code)
    {
        $listDepartments = $this->departmentRepository->findAllExcept($code);
        return new ResponseObject('success', 'Lấy danh sách phòng ban có code khác '.$code.'thành công!', $listDepartments);
    }

}
