<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\ApplySellerStore;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $limit = 10;
        $verify = 1;
        if (isset($request->limit)) {
            $limit = $request->limit;
        }
        $sellers = Seller::with(['products' => function ($q) {
            return $q->select('id', 'seller_id');
        }])->isVerified($verify)->orderBy('id', 'desc')->paginate($limit);
        if ($sellers) {

            return send_data($sellers, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplySellerStore $request)
    {
        $p = new Seller();
        $p->name = $request->name;
        $p->shop_name = $request->shop_name;
        $p->slug = Str::slug($request->shop_name);
        $p->email = $request->email;
        $p->phone = $request->phone;
        $p->address = $request->address;
        $p->password =  Hash::make($request->password);
        $p->save();
        return send_msg('Create Success', true, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {

        $seller = Seller::where('slug', $slug)->first();

        $limit = 10;
        if (isset($request->limit)) {
            $limit = $request->limit;
        }
        if (isset($request->sort)) {
            $sort = $request->sort;
            $products = $seller->products()->conditionProduct($sort)->orderBy('id','desc')->paginate($limit);
        } else {
            $products = $seller->products()->orderBy('id','desc')->paginate($limit);
        }








        // return response()->json([
        //     'seller' => $seller,
        //     'products' => $products
        // ], 200);


        return send_data([
            'seller' => $seller,
            'products' => $products
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
