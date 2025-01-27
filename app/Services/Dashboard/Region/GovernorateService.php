<?php

namespace App\Services\Dashboard\Region;

use App\Repositories\Dashboard\Region\GovernorateRepository;

class GovernorateService
{
    /**
     * Create a new class instance.
     */
    protected $governorateRepository;
    public function __construct(GovernorateRepository $governorateRepository)
    {
        $this->governorateRepository = $governorateRepository;
    }
    public function getGovernorates()
    {
        $governorates = $this->governorateRepository->getGovernorates();
        if (!$governorates) {
            return abort(404);
        }
        return $governorates;
    }

    public function getGovernorate($id) {
        $governorate = $this->governorateRepository->getGovernorate($id);
        if (!$governorate) {
            abort(404);
        }
        return $governorate;
    }

    public function deleteGovernorate($id)
    {
        $governorate = $this->governorateRepository->getGovernorate($id);
        if (!$governorate) {
            return false;
        }
        return $this->governorateRepository->deleteGovernorate($governorate);
    }

    public function changeStatus($id)
    {
        $governorate = $this->governorateRepository->getGovernorate($id);
        if (!$governorate) {
            abort(404);
        }
        $governorate = $this->governorateRepository->changeStatus($governorate);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }

    public function changeShippingPrice($governorate_id, $price) {
        $governorate = $this->governorateRepository->getGovernorate($governorate_id);
        if (!$governorate) {
            abort(404);
        }
        $governorate = $this->governorateRepository->changeShippingPrice($governorate, $price);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }
}
