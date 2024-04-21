<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Company;
use App\Models\Department;
use App\Services\CompanyService;
use App\Services\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    private CompanyService $companyService;
    private DepartmentService $departmentService;

    public function __construct()
    {
        $this->companyService = new CompanyService();
        $this->departmentService = new DepartmentService();
    }
    public function index()
    {
        //
    }

    public function create($companyId)
    {
        $response = $this->companyService->getById($companyId);
        return view('department.create', [
            'company' => $response->getData(),
        ]);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $companyId = $request->company_id;
        $response = $this->departmentService->save($request);
        return redirect()->route('companies.edit', $companyId)
            ->with($response->getStatus(), $response->getMessage());
    }

    public function edit($code)
    {
        $departments = $this->departmentService->getListExcept($code)->getData();
        $department = $this->departmentService->getById($code)->getData();
//        dd($department->code);
        return view('department.edit',[
            'department'=>$department,
            'departments'=>$departments,
        ]);
    }

    public function update(StoreDepartmentRequest $request, $code)
    {
        $response = $this->departmentService->update($request, $code);

        return redirect()->route('companies.edit', $response->getData()->company_id)
            ->with($response->getStatus(), $response->getMessage());
    }

    public function destroy($code)
    {
        $department = $this->departmentService->getById($code)->getData();
        $response = $this->departmentService->delete($code);
        return redirect()->route('companies.edit', $department->company_id)
            ->with($response->getStatus(), $response->getMessage());
    }
}
