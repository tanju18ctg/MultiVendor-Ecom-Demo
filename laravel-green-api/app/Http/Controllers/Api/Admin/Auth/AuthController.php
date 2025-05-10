<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AdminLoginRequest;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function adminLogin(AdminLoginRequest $request)
    {


        $credentials = request()->only('email', 'password');
        if (auth()->guard('admin')->attempt($credentials)) {
            config(['auth.guards.api.provider' => 'admin']);
            $admin = auth()->guard('admin')->user();
            $data['token_type'] = "Bearer";
            $data['access_token'] = $admin->createToken('adminToken', ['admin'])->accessToken;
            $data['admin'] = $admin;
            return send_data($data, 200);

            // return send_data('Admin Login Success',$data,200);
        } else {
            $res['email'][0] = 'Email Or password incorrect.';
            return response()->json(['errors' => $res], 401);
        }
    }

    public function user()
    {
        $data = auth('admin-api')->user();
        return send_data($data, 200);
    }

    public function adminLogout(Request $request)
    {

        $tokenRepository = app('Laravel\Passport\TokenRepository');
        $user = auth('admin-api')->user();

        if ($user) {
            $tokenRepository->revokeAccessToken($user->token()->id);
            $user->token()->delete();
            return send_succ_msg('Logged out successfully', 200);
        } else {
            return send_succ_msg('Already Logged out', 200);
        }

        // $logout =  Auth::user()->token()->revoke();
        // return response()->json(['message' => 'Admin Logout Success'],200);

    }


    public function sellerVerify($id){
        $s = Seller::find($id);
        $s->update(['isVerified'=>1]);
        return send_succ_msg('Verify Done', 200);
    }
}
