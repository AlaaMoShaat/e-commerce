<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\WorldService;

class WorldController extends Controller
{
    protected $worldService;
    public function __construct(WorldService $worldService)
    {
        $this->worldService = $worldService;
    }

    public function index()
    {
        $countries = $this->worldService->getCountries();

        $cities = $this->worldService->getCities();
        return view('dashboard.world.index', compact(['countries', 'governorates', 'cities']));
    }

    public function getCountries()
    {
        $countries = $this->worldService->getCountries();
        return $countries;
    }

    public function getCountryGovernorates($country_id)
    {
        $governorates = $this->worldService->getCountryGovernorates($country_id);
        return $governorates;
    }

    public function getGovernorateCities($governorate_id)
    {
        $cities = $this->worldService->getGovernorateCities($governorate_id);
        return $cities;
    }

    public function changeStatus($country_id)
    {
        $country = $this->worldService->changeCountryStatus($country_id);
        if (!$country) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->back()->with('success', __('messages.success_msg'));
    }
}