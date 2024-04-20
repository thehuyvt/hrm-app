<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Company;
use App\Models\Person;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()->with('people')->paginate(10);

//        dd($projects);
        return view('project.index', [
           'projects'=>$projects,
        ]);
    }



    public function create()
    {
        $companies = Company::all();
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

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
