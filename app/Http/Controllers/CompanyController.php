<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::query()->get();
        return view('company.index', [
            'companies' => $companies,
        ]);
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        Company::query()->create($request->validated());
        return redirect()->route('companies.index')
            ->with('success', 'Add company successful!');
    }

    public function edit($companyId)
    {
        $company = Company::query()->find($companyId);
        $departments = Department::tree($company->department);
//        dd($departments);
        return view('company.edit', [
            'company' => $company,
            'departments' => $departments,
        ]);
    }

    public function update(StoreCompanyRequest $request, $companyId)
    {
        $company = Company::query()->find($companyId);
        $company->update($request->validated());
        return redirect()->route('companies.index')
            ->with('success', 'Update company successful!');
    }

    public function destroy($company_id)
    {
        Company::destroy($company_id);
        return redirect()->route('companies.index')
            ->with('success', 'Delete company successful!');
    }
}
