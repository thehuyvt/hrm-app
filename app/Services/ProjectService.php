<?php

namespace App\Services;



use App\Http\Requests\StoreCountryRequest;
use App\Models\Country;
use App\Repositories\CompanyRepository;
use App\Repositories\CountryRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\RoleRepository;
use App\Response\ResponseObject;

class ProjectService
{
    private ProjectRepository $projectRepository;
    public function __construct()
    {
        $this->projectRepository = new ProjectRepository();
    }


    public function getAll():ResponseObject
    {
        $projects = $this->projectRepository->findAll();

        return new ResponseObject('success', "Lấy danh sách các dự án thành công!", $projects);
    }

    public function getById($id)
    {
        $project =  $this->projectRepository->findById($id);
        return new ResponseObject('success', "Lấy dự án thành công!", $project);

    }

    public function save($request):ResponseObject
    {
        $project = $this->projectRepository->save($request);
        return new ResponseObject('success', 'Thêm dự án thành công!', $project);
    }

    public function update($request, $id)
    {
        $project = $this->projectRepository->update($request, $id);
        return new ResponseObject('success', 'Sửa thông tin dự án thành công!', $project);
    }

    public function delete($id)
    {
        $this->projectRepository->delete($id);
        return new ResponseObject('success', 'Xóa dự án thành công!', null);
    }

}
