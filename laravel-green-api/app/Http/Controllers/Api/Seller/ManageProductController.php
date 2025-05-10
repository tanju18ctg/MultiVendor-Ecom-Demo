<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\seller\StoreProductRequest;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManageProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // return Seller::files();
        $limit = 10;
        $status = "active";
        if (isset($request->limit)) $limit = $request->limit;
        if (isset($request->status)) $status = $request->status;

        $products = auth('seller-api')->user()->products()->status($status)->orderBy('id', 'desc')->paginate($limit);
        if ($products) {

            return send_data($products, 200);
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
    public function store(StoreProductRequest $request)
    {
        $request['slug'] = Str::slug($request->name);
        $request['added_by'] = 'seller';
        $request['seller_id'] =  auth('seller-api')->user()->id;
        $product = Product::create($request->all());
        if ($product) {
            return send_msg('Create Success', true, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $this->authorize('seller-p', $product);
        return send_data($product, 200);
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

        $request['slug'] = Str::slug($request->name);
        // $request['added_by'] = 'seller';
        // $request['seller_id'] =  auth('seller-api')->user()->id;
        $data = Product::find($id);
        $this->authorize('seller-p', $data);
        $data->update($request->all());
        return send_msg('Update Success', true, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Product::findOrFail($id);
        $this->authorize('seller-p', $p);
        $p->delete();
        return send_msg('Delete Success', true, 200);
    }

    public function multipleDelete(Request $request)
    {
        foreach ($request->all() as $pId) {
            $p = Product::findOrFail($pId);
            $this->authorize('seller-p', $p);
            $p->delete();
        }
        return send_msg('Delete Success', true, 200);
    }
}
