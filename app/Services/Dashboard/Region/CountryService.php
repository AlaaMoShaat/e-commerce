<?php

namespace App\Services\Dashboard\Region;

use App\Repositories\Dashboard\Region\CountryRepository;

class CountryService
{
    protected $countryRepository;
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function getCountries()
    {
        $countries = $this->countryRepository->getCountries();
        if (!$countries) {
            abort(404);
        }
        return $countries;
    }

    public function getCountry($id)
    {
        $country = $this->countryRepository->getCountry($id);
        if (!$country) {
            abort(404);
        }
        return $country;
    }
    public function createCountry($data)
    {
        $country = $this->countryRepository->createCountry($data);
        if (!$country) {
            return false;
        }
        return $country;
    }
    public function updateCountry($data, $id)
    {
        $country = $this->countryRepository->getCountry($id);
        if (!$country) {
            abort(404);
        }
        $country =  $this->countryRepository->updateCountry($data, $country);
        if (!$country) {
            return false;
        }
        return $country;
    }
    public function deleteCountry($id)
    {
        $country = $this->countryRepository->getCountry($id);
        if (!$country) {
            abort(404);
        }
        return $this->countryRepository->deleteCountry($country);
    }
    public function changeStatus($id)
    {
        $country = $this->countryRepository->getCountry($id);
        if (!$country) {
            abort(404);
        }
        $country = $this->countryRepository->changeStatus($country);
        if (!$country) {
            return false;
        }
        return $country;
    }
}