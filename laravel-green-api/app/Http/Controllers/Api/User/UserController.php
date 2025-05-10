<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function storeDelivery(Request $request)
    {

        $authId = auth('user-api')->user()->id;
        $user = User::find($authId);
        $user->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'address' => $request->address,
        ]);

        return send_succ_msg('Delivery Address Store successfully', 200);
    }

    public function myDeliveryAddress()
    {
        $authId = auth('user-api')->user()->id;
        // $user = User::with(['division'])->find($authId, ['name', 'phone']);
        $user = User::find($authId)->with([
            'division','district' => function ($query) {
                $query->select('id', 'name', 'bn_name');
            },

        ])->select('address','district_id','division_id')->first();
        return send_data($user, 200);

    }

    public function deliveryCharge(){
        $d_charge = auth('user-api')->user()->division()->select('charge')->first();
        return send_data($d_charge, 200);
    }


}
