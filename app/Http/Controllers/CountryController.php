<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        $response = $this->countryService->getAll();
        return view('country.index',[
            'countries' => $response->getData(),
        ]);
    }

    public function create()
    {
        return view('country.create');
    }

    public function store(StoreCountryRequest $request)
    {
        $response = $this->countryService->save($request);
        return redirect()->route('countries.index')
            ->with($response->getStatus(), $response->getMessage());
    }

    public function edit($countryId)
    {
        $response = $this->countryService->getById($countryId);
        return view('country.edit',[
            'country'=>$response->getData(),
        ]);
    }

    public function update(StoreCountryRequest $request, $countryId)
    {
        $response = $this->countryService->update($request, $countryId);
        return redirect()->route('countries.index')
            ->with($response->getStatus(), $response->getMessage(), null);
    }

    public function destroy($countryId)
    {
       $response =  $this->countryService->delete($countryId);
        return redirect()->route('countries.index')
            ->with($response->getStatus(), $response->getMessage());
    }
}
