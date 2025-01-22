<?php

namespace App\Repositories\Dashboard\Region;

use App\Models\Governorate;

class GovernorateRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function getGovernorates()
    {
        $governorates = Governorate::with('shippingGovernorate')->withCount(['cities', 'users'])->when(!empty(request()->keyword), function($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })->paginate(6);
        return $governorates;
    }

    public function getGovernorate($id)
    {
        return Governorate::with(['cities', 'users'])->find($id);
    }
    public function deleteGovernorate($governorate)
    {
        return $governorate->delete();
    }
    public function changeStatus($governorate)
    {
        $governorate = $governorate->update([
            'status' => $governorate->status == '1' ? '0' : '1',
        ]);
        return $governorate;
    }

    public function changeShippingPrice($governorate, $price) {
        $governorate = $governorate->shippingGovernorate->update([
            'price' => $price,
        ]);
        return $governorate;
    }
}
