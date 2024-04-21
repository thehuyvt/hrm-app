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

        return view('project.index', [
           'projects'=>$projects,
        ]);
    }



    public function create()
    {
        $companies = $this->companyService->getAll()->getData();
        foreach ($companies as $company){
            $company->people = Person::query()->where('company_id', $company->id)->get();
        }

        return view('project.create', [
            'companies'=>$companies,
        ]);
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::query()->create([
            'name' => $request->name,
            'description' => $request->description,
            'company_id' => $request->company_id,
        ]);
        $project->people()->sync($request['people']);
        return redirect()->route('projects.index')
            ->with('success', 'Thêm mới dự án thành công!');
    }

    public function edit($code)
    {
        $project = Project::query()->where('code', $code)->first();
        $person = Person::query()->where('id', 2)->first();
        dd($person->projects);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
