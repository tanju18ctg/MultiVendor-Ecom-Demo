<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\userLoginRequest;
use App\Http\Requests\frontend\UserOtpCodeRequest;
use App\Http\Requests\frontend\UserOtpCodeVerifyRequest;
use App\Http\Requests\frontend\userRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Twilio\Rest\Client;

class AuthController extends Controller
{

    public function userRegister(userRegisterRequest $request)
    {
        $data = $request->validated();
        //make avatar
        $path = 'uploads/users/';
        $fontPath = public_path('fonts/Oliciy.ttf');
        $char = strtoupper($request->name[0]);
        $newAvatarName = Str::slug($request->name) . rand(12, 34353) . '_avatar.png';
        $dest = $path . $newAvatarName;

        $createAvatar = makeAvatar($fontPath, $dest, $char);
        $image = $path . $createAvatar == true ? $newAvatarName : '';
        $saveImage = $path . $image;

        $data['password'] = Hash::make($request->password);
        $data['isVerified'] = true;
        $data['image'] = $saveImage;
        $user = User::create($data);

        $data = $this->accessToken($user);
        return send_data($data, 200);
    }

    //this step we will send sms to mobile number
    public function sendOtp(UserOtpCodeRequest $request)
    {
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

        $twilio = new Client($sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create("+88" . $request->phone, "sms");

        // return response()->json($verification->status);

        $number = sprintf(
            "%s******%s",
            substr($request->phone, 0, 3),
            substr($request->phone, 9)

        );

        return response()->json([
            'message' => 'Otp Send Success',
            'status' => $verification->status,
            'phone' => $number,
        ], 200);
    }

    //we will check verify code
    public function verifyOtp(UserOtpCodeVerifyRequest $request)
    {

        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

        $twilio = new Client($sid, $token);

        $verification_check  = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(
                $request->otp_code, // code
                ["to" => "+88" . $request->phone]
            );
        // return response()->json($verification_check->status);

        $number = sprintf(
            "%s******%s",
            substr($request->phone, 0, 3),
            substr($request->phone, 9)
        );

        if ($verification_check->status === "pending") {
            $data['otp_code'][0] = 'The otp code is invalid';
            return response()->json(['errors' => $data], 401);
        } else {
            return response()->json([
                'message' => 'Otp Verify Success',
                'status' => $verification_check->status,
                'phone' => $number
            ], 200);
        }
    }


    public function userLogin(userLoginRequest $request)

    {
        $data = $this->accessToken($request->validated());
        if ($data) {
            return send_data($data, 200);
        } else {
            $res['phone'][0] = 'Phone Or password incorrect.';
            return response()->json(['errors' => $res], 401);
        }
    }

    public function accessToken($credentials)
    {
        $credentials = request()->only('email', 'password', 'phone');

        if (auth()->guard('user')->attempt($credentials)) {
            config(['auth.guards.api.provider' =>  'user']);
            $user = auth()->guard('user')->user();
            $data['token_type'] = "Bearer";
            $data['access_token'] = $user->createToken('userToken', ['user'])->accessToken;
            $data['user'] = $user;
            return $data;
        }
    }

    public function home()
    {
        return Auth::user();
    }



    // public function userLogout(Request $request)
    // {
    //     $request->user()
    //         ->tokens
    //         ->each(function ($token, $key) {
    //             $this->revokeAccessAndRefreshTokens($token->id);
    //         });
    //     return send_succ_msg('Logged out successfully',200);
    // }

    // protected function revokeAccessAndRefreshTokens($tokenId)
    // {
    //     $tokenRepository = app('Laravel\Passport\TokenRepository');
    //     $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');

    //     $tokenRepository->revokeAccessToken($tokenId);
    //     $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId);
    // }

    public function userLogout(Request $request)
    {

        $tokenRepository = app('Laravel\Passport\TokenRepository');
        $user = auth('user-api')->user();

        if ($user) {
            $tokenRepository->revokeAccessToken($user->token()->id);
            $user->token()->delete();

            return send_succ_msg('Logged out successfully', 200);
        } else {
            return send_succ_msg('Already Logged out', 200);
        }

        //     $request->user()->token()->revoke();
        //    return send_succ_msg('Logged out successfully',200);
    }

    public function profileImgChange(Request $request)
    {
        $user = User::find(Auth::id());
        $path = 'uploads/users';
        // $uploadPath = public_path($path);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = Str::slug($user->name) . time() . "." . $file->getClientOriginalExtension();
            Image::make($file)->resize(200, 200)->save('uploads/users/' . $name);
            $oldImg = public_path($user->image);
            @unlink($oldImg);
            $saveName = $path . '/' . $name;
        }
        $user->update([
            'image' => $saveName
        ]);
        $data['user'] = $user;
        return send_data($data, 200);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $data['user'] = $user;
        return send_data($data, 200);
    }
}
