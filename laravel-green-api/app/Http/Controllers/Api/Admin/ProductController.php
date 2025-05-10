<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\product\ProductUpdate;
use App\Http\Requests\backend\product\ProudctStore;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 10;
        $status = "active";
        if (isset($request->limit)) $limit = $request->limit;
        if (isset($request->status)) $status = $request->status;

        $products = Product::adminProducts()->status($status)->orderBy('id', 'desc')->paginate($limit);
        if ($products) {

            return send_data($products, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function sellerProducts(Request $request)
    {
        $limit = 10;
        $status = "active";
        if (isset($request->limit)) $limit = $request->limit;
        if (isset($request->status)) $status = $request->status;

        $products = Product::sellerProducts()->status($status)->orderBy('id', 'desc')->paginate($limit);
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
    public function store(ProudctStore $request)
    {
        $request['slug'] = Str::slug($request->name);
        $request['added_by'] = 'admin';
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
        $product = Product::findOrFail($id);
        return send_data($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request, $id)
    {
        $request['slug'] = Str::slug($request->name);
        $cat = Product::find($id);
        $cat->update($request->all());
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
        //    @unlink(public_path().$category->image);
        // $user->photos()->delete();
        $p->delete();
        return send_msg('Delete Success', true, 200);
    }

    public function multipleDelete(Request $request)
    {
        foreach ($request->all() as $pId) {
            $p = Product::findOrFail($pId);
            // @unlink(public_path().$category->image);
            $p->delete();
        }
        return send_msg('Delete Success', true, 200);
    }
}
