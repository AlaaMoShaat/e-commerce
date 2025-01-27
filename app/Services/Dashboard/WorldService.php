<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\WorldRepository;

class WorldService
{
    /**
     * Create a new class instance.
     */
    protected $worldRepository;
    public function __construct(WorldRepository $worldRepository)
    {
        $this->worldRepository = $worldRepository;
    }

    ########### Country #############
    public function getCountries()
    {
        $countries = $this->worldRepository->getCountries();
        if (!$countries) {
            abort(404);
        }
        return $countries;
    }
    public function getCountry($id)
    {
        $country = $this->worldRepository->getCountry($id);
        if (!$country) {
            abort(404);
        }
        return $country;
    }

    public function changeCountryStatus($id)
    {
        $country = $this->worldRepository->getCountry($id);
        if (!$country) {
            abort(404);
        }
        $country = $this->worldRepository->changeCountryStatus($country);
        if (!$country) {
            return false;
        }
        return $country;
    }

    ########### Governorate #############
    public function getCountryGovernorates($country_id)
    {
        $country = $this->worldRepository->getCountry($country_id);
        $governorates = $this->worldRepository->getCountryGovernorates($country);
        if (!$governorates) {
            abort(404);
        }
        return $governorates;
    }
    public function getGovernorateCities($governorate_id)
    {
        $governorate = $this->worldRepository->getGovernorate($governorate_id);
        $cities = $this->worldRepository->getGovernorateCities($governorate);
        if (!$cities) {
            abort(404);
        }
        return $cities;
    }

    public function getGovernorate($id)
    {
        $governorate = $this->worldRepository->getGovernorate($id);
        if (!$governorate) {
            abort(404);
        }
        return $governorate;
    }

    ########### Citeis #############
    public function getCities()
    {
        $citeis = $this->worldRepository->getCities();
        if (!$citeis) {
            abort(404);
        }
        return $citeis;
    }

    public function getCity($id)
    {
        $city = $this->worldRepository->getCity($id);
        if (!$city) {
            abort(404);
        }
        return $city;
    }
}