<?php

namespace App\Http\Controllers\Dashboard\Region;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\Region\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $cityService;
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = $this->cityService->getCities();
        return view('dashboard.regions.cities.index', compact('cities'));
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
        //
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
        $city = $this->cityService->deleteCity($id);
        if (!$city) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    public function changeStatus($id)
    {
        $city = $this->cityService->changeStatus($id);
        if (!$city) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $city = $this->cityService->getCity($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $city], 200);
    }
}
