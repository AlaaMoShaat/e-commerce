<?php

namespace App\Http\Controllers\Dashboard\Region;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PriceRequest;
use App\Services\Dashboard\Region\CityService;
use App\Services\Dashboard\Region\CountryService;
use App\Services\Dashboard\Region\GovernorateService;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $governorateService, $countryService , $citiesService;
    public function __construct(GovernorateService $governorateService, CityService $citiesService, CountryService $countryService)
    {
        $this->governorateService = $governorateService;
        $this->citiesService = $citiesService;
        $this->countryService = $countryService;
    }

    public function index()
    {
        $governorates = $this->governorateService->getGovernorates();
        return view('dashboard.regions.governorates.index', compact('governorates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $governorate = $this->governorateService->getGovernorate($id);
        if(!$governorate) {
            return redirect()->route('dashboard.governorates.index')->with('error', __('messages.not_found'));
        }
        return view('dashboard.regions.governorates.show', compact('governorate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = $this->governorateService->deleteGovernorate($id);
        if (!$country) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }

        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    public function changeStatus($id)
    {
        $governorate = $this->governorateService->changeStatus($id);
        if (!$governorate) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $governorate = $this->governorateService->getGovernorate($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $governorate], 200);
    }

    public function changeShippingPrice(PriceRequest $request, $id) {
        $governorate = $this->governorateService->changeShippingPrice($id, $request->price);
        if (!$governorate) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 400);
        }
        $governorate = $this->governorateService->getGovernorate($id);

        $governorate->load('shippingGovernorate');
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $governorate], 200);
    }
}