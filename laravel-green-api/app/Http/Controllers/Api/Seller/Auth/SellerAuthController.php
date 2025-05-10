<?php

namespace App\Http\Controllers\Api\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerAuthController extends Controller
{
    public function sellerLogin(Request $request){
        $credentials = request()->only('email','password');
        if (auth()->guard('seller')->attempt($credentials)) {
            config(['auth.guards.api.provider' => 'seller']);
            $seller = auth()->guard('seller')->user();
            $data['token_type'] = "Bearer";
            $data['access_token'] = $seller->createToken('sellerToken',['seller'])->accessToken;
            $data['seller'] = $seller;
            return send_data($data, 200);

            // return send_data('Admin Login Success',$data,200);
        }else {
            $res['email'][0] = 'Email Or password incorrect.';
            return response()->json(['errors' => $res], 401);
        }
    }
}
