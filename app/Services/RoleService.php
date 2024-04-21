<?php

namespace App\Services;



use App\Http\Requests\StoreCountryRequest;
use App\Models\Country;
use App\Repositories\CompanyRepository;
use App\Repositories\CountryRepository;
use App\Repositories\RoleRepository;
use App\Response\ResponseObject;

class RoleService
{
    private RoleRepository $roleRepository;
    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
    }


    public function getAll():ResponseObject
    {
        $roles = $this->roleRepository->findAll();
        return new ResponseObject('success', "Lấy danh sách các quốc gia thành công!", $roles);
    }

    public function getById($id)
    {
        $role =  $this->roleRepository->findById($id);
        return new ResponseObject('success', "Lấy quyền thành công!", $role);

    }

    public function save($request):ResponseObject
    {
        $role = $this->roleRepository->save($request);
        return new ResponseObject('success', 'Thêm quyền thành công!', $role);
    }

    public function update($request, $id)
    {
        $role = $this->roleRepository->update($request, $id);
        return new ResponseObject('success', 'Sửa thông tin quyền thành công!', $role);
    }

    public function delete($id)
    {
        $this->roleRepository->delete($id);
        return new ResponseObject('success', 'Xóa quyền thành công!', null);
    }

}
