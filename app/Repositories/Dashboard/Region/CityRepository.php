<?php

namespace App\Repositories\Dashboard\Region;

use App\Models\City;

class CityRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getCity($id)
    {
        return City::find($id);
    }

    public function getCities()
    {
        $cities = City::when(!empty(request()->keyword), function($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })->paginate(6);
        return $cities;
    }

    public function deleteCity($city)
    {
        return $city->delete();
    }

    public function getCitiesByGovernorate($governorate_id)
    {
        return City::where('governorate_id', $governorate_id)->paginate(6);
    }

    public function changeStatus($city)
    {
        $city = $city->update([
            'status' => $city->status == 'active' ? '0' : '1',
        ]);
        return $city;
    }
}