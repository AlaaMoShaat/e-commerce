<?php

namespace App\Repositories\Dashboard;

use App\Models\Brand;

class BrandRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getBrand($id) {
        return Brand::find($id);
    }
    public function getBrands() {
        $brands = Brand::withCount('products')->latest()->get();
        return $brands;
    }
    public function createBrand($data) {
        return Brand::create($data);
    }
    public function updateBrand($data, $brand) {
        $brand->update($data);
        return $brand;
    }

    public function deleteBrand($brand) {
        return $brand->delete();
    }

    public function changeStatus($brand)
    {
        $brand = $brand->update([
            'status' => $brand->status == '1' ? '0' : '1',
        ]);
        return $brand;
    }
}