<?php

namespace App\Repositories;

use App\Http\Requests\StoreCountryRequest;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;

class CountryRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Country();
    }

    public function findAll()
    {
        return $this->model->query()->paginate(10);
    }

    public function findById($id)
    {
        return $this->model->query()->find($id);
    }


    public function save($request)
    {
        return $this->model->query()->create($request->validated());
    }

    public function update($request, $id)
    {
        $country = $this->model->query()->find($id);
        $country->update($request->validated());
        return $country;
    }

    public function delete($id)
    {
        Country::destroy($id);
    }
}
