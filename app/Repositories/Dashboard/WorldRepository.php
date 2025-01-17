<?php

namespace App\Repositories\Dashboard;

use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;

class WorldRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    ############## Country ###############
    public function getCountries()
    {
        return Country::all();
    }

    public function getCountry($id)
    {
        return Country::find($id);
    }

    public function changeCountryStatus($country)
    {
        $country = $country->update([
            'state' => $country->status == 'active' ? '0' : '1',
        ]);
        return $country;
    }

    ############## Governorate ###############
    public function getCountryGovernorates($countery)
    {
        $governorates = $countery->governorates()->get();
        return $governorates;
    }

    public function getGovernorateCities($governorate)
    {
        $cities = $governorate->cities()->get();
        return $cities;
    }

    public function getGovernorate($id)
    {
        return Governorate::find($id);
    }

    ############## City ###############

    public function getCities()
    {
        return City::all();
    }

    public function getCity($id)
    {
        return City::find($id);
    }
}