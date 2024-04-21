<?php

namespace App\Services;




use App\Repositories\UserRepository;
use App\Response\ResponseObject;

class UserService
{
    private UserRepository $userRepo;
    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }


    public function getAll():ResponseObject
    {
        $users = $this->userRepo->findAll();

        return new ResponseObject('success', "Lấy danh sách người dùng thành công!", $users);
    }

    public function getById($countryId)
    {
        $country =  $this->userRepo->findById($countryId);
        return new ResponseObject('success', "Lấy danh sách người dùng thành công!", $country);

    }

    public function save($request):ResponseObject
    {
        $user = $this->userRepo->save($request);
        $user->person()->create([
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'company_id' => $request->company_id,
        ]);
        $roles = $request['listRoleId'];
        $user->roles()->sync($roles);

        return new ResponseObject('success', 'Thêm người dùng thành công!', null);
    }

    public function update($request, $id)
    {
        $user = $this->userRepo->update($request, $id);
        $user->person()->update([
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);
        $roles = $request['listRoleId'];
        $user->roles()->sync($roles);
        return new ResponseObject('success', 'Sửa thông tin người dùng thành công!', null);
    }

    public function delete($id)
    {
        $this->userRepo->delete($id);
        return new ResponseObject('success', 'Xóa người dùng thành công!', null);
    }


}
