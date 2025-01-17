<?php

namespace App\Repositories\Dashboard\Region;

use App\Models\Country;

class CountryRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getCountries()
    {
        $countries = Country::when(!empty(request()->keyword), function($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })->paginate(6);
        return $countries;
    }

    public function getCountry($id)
    {
        return Country::with('governorates')->find($id);
    }

    public function createCountry($data)
    {
        return Country::create($data);
    }

    public function updateCountry($data, $country)
    {
        return $country->update($data);
    }

    public function deleteCountry($country)
    {
        return $country->delete();
    }

    public function changeStatus($country)
    {
        $country = $country->update([
            'status' => $country->status == 'active' ? '0' : '1',
        ]);
        return $country;
    }
}