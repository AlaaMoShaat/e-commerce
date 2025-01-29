<?php

namespace App\Repositories\Dashboard;

use App\Models\Coupon;

class CouponRepository
{
    public function getCoupon($id) {
        return Coupon::find($id);
    }

    public function getCoupons() {
        return Coupon::latest()->get();
    }

    public function createCoupon($data) {
        return Coupon::create($data);
    }

    public function updateCoupon($coupon, $data) {
        $coupon->update($data);
        return $coupon;
    }
    public function deleteCoupon($coupon) {
        return $coupon->delete();
    }
    public function changeStatus($coupon) {
        $coupon = $coupon->update([
           'status' => $coupon->status == '1'? '0' : '1',
        ]);
        return $coupon;
    }
 }