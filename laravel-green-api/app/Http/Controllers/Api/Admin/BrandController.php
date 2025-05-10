<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\brand\StoreRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
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

        $brands = Brand::Status($status)->orderBy('id', 'desc')->paginate($limit);
        if ($brands) {

            return send_data($brands, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function brandAll()
    {
        $brands = Brand::Published()->orderBy('name', 'Asc')->get();
        if ($brands) {

            return send_data($brands, 200);
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
    public function store(StoreRequest $request)
    {
        $request['slug'] = Str::slug($request->name);
        Brand::create($request->all());
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
        $brand = Brand::findOrFail($id);
        return send_data($brand, 200);
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
        $brand = Brand::find($id);
        $request['slug'] = Str::slug($request->name);
        $brand->update($request->all());
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
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return send_msg('Delete Success', true, 200);
    }



    public function multipleDelete(Request $request)
    {
        foreach ($request->all() as $bId) {
            $brand = Brand::findOrFail($bId);
            $brand->delete();
        }
        return send_msg('Delete Success', true, 200);
    }
}
