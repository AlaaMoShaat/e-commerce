<?php

namespace App\Http\Controllers\Dashboard\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CountryRequest;
use App\Services\Dashboard\Region\CityService;
use App\Services\Dashboard\Region\CountryService;
use App\Services\Dashboard\Region\GovernorateService;

class CountryController extends Controller
{
    protected $countryService, $governorateService, $cityService;
    public function __construct(
        CountryService $countryService,
        GovernorateService $governorateService,
        CityService $cityService
    ) {
        $this->countryService = $countryService;
        $this->governorateService = $governorateService;
        $this->cityService = $cityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = $this->countryService->getCountries();
        return view('dashboard.regions.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.regions.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $data = $request->only(['name', 'phone_code', 'iso_code', 'status']);

        $country = $this->countryService->createCountry($data);
        if (!$country) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.countries.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country = $this->countryService->getCountry($id);
        if (!$country) {
            return redirect()->route('dashboard.countries.index')->with('error', __('messages.failed_msg'));
        }
        return view('dashboard.regions.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = $this->countryService->getCountry($id);
        return view('dashboard.regions.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        $data = $request->only(['name', 'phone_code', 'iso_code', 'status']);

        $country = $this->countryService->updateCountry($data, $id);
        if (!$country) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.countries.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = $this->countryService->deleteCountry($id);
        if (!$country) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }

        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    public function changeStatus($id)
    {
        $country = $this->countryService->changeStatus($id);
        if (!$country) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $country = $this->countryService->getCountry($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $country], 200);
    }
}