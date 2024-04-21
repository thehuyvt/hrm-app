<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\Department;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyService $companyService;

    public function __construct()
    {
        $this->companyService = new CompanyService();
    }
    public function index()
    {
        $response = $this->companyService->getAll();
        return view('company.index', [
            'companies' => $response->getData(),
        ]);
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $response = $this->companyService->save($request);
        return redirect()->route('companies.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    public function edit($companyId)
    {
        $company = $this->companyService->getById($companyId)->getData();
        $departments = $this->companyService->getListDepartmentInCompany($companyId)->getData();
//        dd($departments);
        return view('company.edit', [
            'company' => $company,
            'departments' => $departments,
        ]);
    }

    public function update(StoreCompanyRequest $request, $companyId)
    {
        $response = $this->companyService->update($request, $companyId);
        return redirect()->route('companies.index')
            ->with($response->getStatus(),
            $response->getMessage());
    }

    public function destroy($company_id)
    {
        $response = $this->companyService->delete($company_id);
        return redirect()->route('companies.index')
            ->with($response->getStatus(), $response->getMessage());
    }
}
