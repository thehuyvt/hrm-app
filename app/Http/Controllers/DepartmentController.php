<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        //
    }

    public function create($companyId)
    {
        $company = Company::query()->find($companyId);
        return view('department.create', [
            'company' => $company,
        ]);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $companyId = $request->company_id;
        Department::query()->create([
            'code' => $request->code,
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('companies.edit', $companyId)
            ->with('success', 'Thêm phòng ban thành công!');
    }

    public function edit($code)
    {
        $departments = Department::query()->where('code', '!=', $code)->get();
        $department = Department::query()->where('code', $code)->firstOrFail();
        return view('department.edit',[
            'department'=>$department,
            'departments'=>$departments,
        ]);
    }

    public function update(StoreDepartmentRequest $request, $code)
    {
        $department = Department::query()->where('code', $code)->firstOrFail();
        DB::table('departments')->where('code', $code)->update($request->validated());
        return redirect()->route('companies.edit', $department->company_id)
            ->with('success', 'Chỉnh sửa phòng ban thành công!');
    }

    public function destroy($code)
    {
        $department = Department::query()->where('code', $code)->firstOrFail();
        DB::table('departments')->where('code', '=', $code)->delete();
        return redirect()->route('companies.edit', $department->company_id)
            ->with('success', 'Xóa phòng ban thành công!');
    }
}
