<?php

namespace App\Repositories;

use App\Models\User;
use App\Response\ResponseObject;

class UserRepository extends Repository
{
    public function __construct()
    {
        $this->model = new User();
    }
    public function findAll()
    {
        return $this->model::query()->with('person')->paginate(10);
    }

    public function save($request)
    {
        return $this->model::query()->create([
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    public function update($request, $id)
    {
        return $this->findById($id)->update([
            'email' => $request->email,
            'password' => $request->password,
        ]);

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
