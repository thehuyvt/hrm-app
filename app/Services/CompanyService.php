<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use App\Repositories\DepartmentRepository;
use App\Response\ResponseObject;

class CompanyService
{
    private CompanyRepository $companyRepository;
    private DepartmentRepository $departmentRepository;
    public function __construct()
    {
        $this->companyRepository = new CompanyRepository();
        $this->departmentRepository = new DepartmentRepository();
    }


    public function getAll():ResponseObject
    {
        $companies = $this->companyRepository->findAll();
        return new ResponseObject('success', "Lấy danh sách các công ty thành công!", $companies);
    }

    public function getById($id)
    {
        $company =  $this->companyRepository->findById($id);
        return new ResponseObject('success', "Lấy thông tin công ty thành công!", $company);

    }

    public function save($request):ResponseObject
    {
        $company = $this->companyRepository->save($request);
        return new ResponseObject('success', 'Thêm công ty thành công!', $company);
    }

    public function update($request, $id)
    {
        $company = $this->companyRepository->update($request, $id);
        return new ResponseObject('success', 'Sửa thông tin công ty thành công!', $company);
    }

    public function delete($id)
    {
        $this->companyRepository->delete($id);
        return new ResponseObject('success', 'Xóa công ty thành công!', null);
    }

    public function getListDepartmentInCompany($companyId)
    {
        $departments =  $this->departmentRepository->findAllDepartmentByCompany($companyId);
        return new ResponseObject('success', 'Lấy danh sách phòng ban trong công ty thành công!', $departments);
    }

}
