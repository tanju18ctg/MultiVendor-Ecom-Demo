<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\ApplyCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function applyCoupon(ApplyCouponRequest $request)
    {

        $coupon = Coupon::where('code', $request->code)->where('status', 'active')->first();
        if ($coupon) {
            $discount = $coupon->discount($request->subtotal);
            return send_data($discount, 200);
        }
    }
}
