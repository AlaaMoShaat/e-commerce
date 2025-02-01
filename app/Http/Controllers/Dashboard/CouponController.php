<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CouponRequest;
use App\Services\Dashboard\CouponService;

class CouponController extends Controller
{
   protected $couponService;
   public function __construct(CouponService $couponService)
   {
     $this->couponService = $couponService;
   }

    public function index()
    {
        return view('dashboard.coupons.index');
    }

    public function getAllCoupons() {
        $coupons = $this->couponService->getCouponsForDatatable();
        return $coupons;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        $data = $request->only(['code', 'discount_percentage', 'start_date', 'end_date', 'limit', 'status']);
        $coupon = $this->couponService->createCoupon($data);
        if (!$coupon) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 201);
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
    public function update(CouponRequest $request, string $id)
    {
        $data = $request->only(['code', 'discount_percentage', 'start_date', 'end_date', 'limit']);
        $coupon = $this->couponService->updateCoupon($id, $data);
        if (!$coupon) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = $this->couponService->deleteCoupon($id);
        if (!$coupon) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg')], 200);
    }

    public function changeStatus($id) {
        $coupon = $this->couponService->changeStatus($id);
        if (!$coupon) {
            return response()->json(['status' => 'failed', 'message' => __('messages.failed_msg')]);
        }
        $coupon = $this->couponService->getCoupon($id);
        return response()->json(['status' => 'success', 'message' => __('messages.success_msg'), 'data' => $coupon], 200);
    }
}
