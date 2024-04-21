<?php

namespace App\Services;



use App\Http\Requests\StoreCountryRequest;
use App\Models\Country;
use App\Repositories\CountryRepository;
use App\Response\ResponseObject;

class CountryService
{
    private CountryRepository $countryRepo;
    public function __construct()
    {
        $this->countryRepo = new CountryRepository();
    }


    public function getAll():ResponseObject
    {
        $countries = $this->countryRepo->findAll();
        return new ResponseObject('success', "Lấy danh sách các quốc gia thành công!", $countries);
    }

    public function getById($countryId)
    {
        $country =  $this->countryRepo->findById($countryId);
        return new ResponseObject('success', "Lấy danh sách các quốc gia thành công!", $country);

    }

    public function save($request):ResponseObject
    {
        $country = $this->countryRepo->save($request);
        return new ResponseObject('success', 'Thêm quốc gia thành công!', $country);
    }

    public function update($request, $id)
    {
        $country = $this->countryRepo->update($request, $id);
        return new ResponseObject('success', 'Sửa thông tin quốc gia thành công!', $country);
    }

    public function delete($id)
    {
        $this->countryRepo->delete($id);
        return new ResponseObject('success', 'Xóa quốc gia thành công!', null);
    }


}
