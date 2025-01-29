<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CouponRepository;
use Yajra\DataTables\Facades\DataTables;

class CouponService
{
    /**
     * Create a new class instance.
     */
    protected $couponRepository;
    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }
    public function getCoupon($id) {
        $coupon = $this->couponRepository->getCoupon($id);
        return $coupon ?? abort(404);
    }
    public function getCouponsForDataTable() {
        $coupons = $this->couponRepository->getCoupons();
        return DataTables::of($coupons)->addIndexColumn()
        ->addColumn('actions', function ($coupon) {
            return view('dashboard.coupons.datatables.actions', compact('coupon'));
        })->addColumn('discount_percentage', function ($coupon) {
            return '%'.$coupon->discount_percentage;
        })->addColumn('status', function($coupon) {
            return view('dashboard.coupons.datatables.statusFeild', compact('coupon'));
        })->make(true);
    }

    public function createCoupon($data) {
        $coupon = $this->couponRepository->createCoupon($data);
        return $coupon ?? false;
    }
    public function updateCoupon($id, $data) {
        $coupon = self::getCoupon($id);
        $coupon = $this->couponRepository->updateCoupon($coupon, $data);
        return $coupon?? false;
    }
    public function deleteCoupon($id) {
        $coupon = self::getCoupon($id);
        $coupon = $this->couponRepository->deleteCoupon($coupon);
        return $coupon?? false;
    }

    public function changeStatus($id) {
        $coupon = self::getCoupon($id);
        $coupon = $this->couponRepository->changeStatus($coupon);
        return $coupon?? false;
    }
}