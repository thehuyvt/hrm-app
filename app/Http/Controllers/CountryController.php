<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Country();
    }
    public function index()
    {
        $countries = $this->model::query()->get();
        return view('country.index',[
            'countries' => $countries,
        ]);
    }

    public function create()
    {
        return view('country.create');
    }

    public function store(CountryRequest $request)
    {
        $this->model::query()->create($request->validated());
        return redirect()->route('countries.index')
            ->with('success', 'Add country successfully!');
    }

    public function edit($countryId)
    {
        $country = $this->model::query()->find($countryId);
        return view('country.edit',[
            'country'=>$country,
        ]);
    }

    public function update(CountryRequest $request, $countryId)
    {
        $country = $this->model::query()->find($countryId);
        $country->update($request->validated());
        return redirect()->route('countries.index')->with('success', "Update country successfully");
    }

    public function destroy($countryId)
    {
        $this->model::destroy($countryId);
        return redirect()->route('countries.index')
            ->with('success', 'Delete country successful!');
    }
}
