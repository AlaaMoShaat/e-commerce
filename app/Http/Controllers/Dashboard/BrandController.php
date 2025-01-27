<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandRequest;
use App\Services\Dashboard\BrandService;

class BrandController extends Controller
{
    protected $brandService;
    public function __construct(BrandService $brandService) {
        $this->brandService = $brandService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brandService->getBrandsForDataTable();
        return view('dashboard.brands.index', compact('brands'));
    }

    public function getAllBrands() {
        $brands = $this->brandService->getBrandsForDataTable();
        return $brands;
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
    public function store(BrandRequest $request)
    {
        $data = $request->only(['name', 'status', 'logo']);
        $brand = $this->brandService->createBrand($data);
        if (!$brand) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.brands.index')->with('success', __('messages.success_msg'));
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
        $brand = $this->brandService->getBrand($id);
        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        $data = $request->only(['name', 'status', 'logo']);
        $brand = $this->brandService->updateBrand($data, $id);
        if (!$brand) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.brands.index')->with('success', __('messages.success_msg'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = $this->brandService->deleteBrand($id);
        if (!$brand) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')], 404);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }


    public function changeStatus($id) {
        $brand = $this->brandService->changeStatus($id);
        if (!$brand) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $brand = $this->brandService->getBrand($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $brand], 200);
    }
}