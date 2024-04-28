<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Company;
use App\Models\Person;
use App\Models\Project;
use App\Services\CompanyService;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    private ProjectService $projectService;
    private CompanyService $companyService;

    public function __construct()
    {
        $this->projectService = new ProjectService();
        $this->companyService = new CompanyService();
    }

    public function index()
    {
        $projects = $this->projectService->getAll()->getData();
//        dd($projects);
        return view('project.index', [
            'projects' => $projects,
        ]);
    }


    public function create()
    {
        $companies = $this->companyService->getAll()->getData();
        return view('project.create', [
            'companies' => $companies,
        ]);
    }

    public function store(StoreProjectRequest $request)
    {
        $response = $this->projectService->save($request);
        return redirect()->route('projects.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    public function edit($code)
    {
        $project = $this->projectService->getById($code)->getData();
//        dd($project->company_id);
        $companies = $this->companyService->getAll()->getData();
        return view('project.edit', [
            'project' => $project,
            'companies' => $companies,
        ]);
    }

    public function update(StoreProjectRequest $request, $code)
    {
        $response = $this->projectService->update($request, $code);
        return redirect()->route('projects.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    public function destroy($code)
    {
        $response = $this->projectService->delete($code);
        return redirect()->route('projects.index')
            ->with($response->getStatus(), $response->getMessage());
    }
}
