<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\seller\ChangePasswordRequest;
use App\Models\FileManagerFile;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellerHomeController extends Controller
{
    public function logout(Request $request)
    {
        $tokenRepository = app('Laravel\Passport\TokenRepository');
        $user = auth('seller-api')->user();

        if ($user) {
            $tokenRepository->revokeAccessToken($user->token()->id);
            $user->token()->delete();
            return send_succ_msg('Logged out successfully', 200);
        } else {
            return send_succ_msg('Already Logged out', 200);
        }
    }


    public function seller()
    {

        $seller = auth('seller-api')->user();
        return send_data($seller, 200);
    }

    public function settingUpdate(Request $request)
    {
        $seller = auth('seller-api')->user();
        $s = Seller::find($seller->id);
        $s->update([
            'name' => $request->name,
            'shop_name' => $request->shop_name,
            'slug' => Str::slug($request->shop_name),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return send_data($seller, 200);
    }

    public function changeImage(Request $request)
    {
        if ($request->file('image')) {
            $path = 'uploads/seller/shop';
            $size = [250, 250];
            $saveImg = uploadImage($request->file('image'), $path, false, $size);
            $sellerID = auth('seller-api')->user()->id;
            $data = Seller::find($sellerID);
            @unlink(public_path() . $data->image);
            $data->update(['image' => $saveImg]);

            return send_succ_msg('Image Change Success', 200);
        }
    }
    public function changePassword(ChangePasswordRequest $request)
    {

        $authUser = auth('seller-api')->user();
        if (Hash::check($request->current_password, $authUser->password)) {
            $s = seller::find($authUser->id);
            $s->update(['password' => Hash::make($request->password)]);
            return send_succ_msg('Password Change Success', 200);
        } else {
            $data['current_password'][0] = "Your current password is not match";
            return send_validation_err_msg($data, 422);
        }
    }
}
