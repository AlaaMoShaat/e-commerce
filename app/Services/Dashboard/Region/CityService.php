<?php

namespace App\Services\Dashboard\Region;

use App\Models\City;
use App\Repositories\Dashboard\Region\CityRepository;

class CityService
{
    /**
     * Create a new class instance.
     */
    protected $cityRepository;
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }
    public function getCities()
    {
        $cities = $this->cityRepository->getCities();
        if (!$cities) {
            abort(404);
        }
        return $cities;
    }

    public function getCity($id)
    {
        $city = $this->cityRepository->getCity($id);
        if (!$city) {
            abort(404);
        }
        return $city;
    }

    public function deleteCity($id)
    {
        $city = self::getCity($id);
        if (!$city) {
            abort(404);
        }
        $city = $this->cityRepository->deleteCity($city);
        if (!$city) {
            return false;
        }
        return $city;
    }
    public function getCitiesByGovernorate($governorate_id)
    {
        $cities = $this->cityRepository->getCitiesByGovernorate($governorate_id);
        if (!$cities) {
            abort(404);
        }
        return $cities;
    }

    public function changeStatus($id)
    {
        $city = self::getCity($id);
        if (!$city) {
            abort(404);
        }
        $city = $this->cityRepository->changeStatus($city);
        if (!$city) {
            return false;
        }
        return $city;
    }
}
