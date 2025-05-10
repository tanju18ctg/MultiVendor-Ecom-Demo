<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {


        $authUser = auth('user-api')->user();
        $user = User::find($authUser->id)->with([
            'division' => function ($query) {
                $query->select('id', 'name');
            },

            'district' => function ($query) {
                $query->select('id', 'name');
            },

        ])->select('address', 'division_id', 'district_id')->first();

        $d_charge = $authUser->division()->pluck('charge')->first();
        $order = Order::create([
            "order_number" => rand(11111111,99999999),
            "user_id" => $authUser->id,
            "shipping_address" => $user->division->name . ',' . $user->district->name . ',' . $user->address,
            "subtotal" => $request->subtotal,
            "discount" => $request->discount,
            "total" => $request->total,
            "charges" => $d_charge,
            "status" => "pending",
        ]);

        foreach ($request->carts as $cart) {
            // $order->orderItems()->create([
            //     'name' => $cart['name'],
            //     'price' => $cart['price'],
            //     'qty' => $cart['quantity'],
            //     'image' => $cart['thumbnail'],
            // ]);
            $product = Product::find($cart['id']);
            $order->products()->attach($product, ['seller_id' => $product->seller_id, 'qty' => $cart['quantity']]);
        }

        return send_succ_msg('Order Store successfully', 200);
    }

    public function index()
    {
        $data = auth('user-api')->user()->orders()->orderBy('id', 'desc')->with(['products'])->get();

        return send_data($data, 200);
    }

    public function view(Request $request)
    {

        $data = Order::with(['products'])->find($request->id);
        // $data = Order::find($request->id)->products()->get();
        // foreach ($order->products as $item) {
        //     $product = Product::where('id',$item->pivot->product_id)->first();
        //     $stock = $product->stock;
        //     $stock -= $item->pivot->quantity;
        //     $product->update(['stock'=> $stock]);
        //     Order::where('id',$request->input('order_id'))->update(['payment_status' => 'paid']);
        // }

        return send_data($data, 200);
    }
}
