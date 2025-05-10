<?php

namespace App\Http\Controllers;

use App\Http\Requests\frontend\ApplySellerStore;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SellerFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id)
    {
        //
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
