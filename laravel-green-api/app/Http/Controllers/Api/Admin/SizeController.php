<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\size\SizeStoreRequest;
use App\Models\Size;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Size::Published()->orderBy('name', 'Asc')->get();
        if ($colors) {

            return send_data($colors, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function paginationData(Request $request)
    {
        $limit = 10;
        $status = "active";
        if (isset($request->limit)) $limit = $request->limit;
        if (isset($request->status)) $status = $request->status;

        $sizes = Size::Status($status)->orderBy('id', 'desc')->paginate($limit);
        if ($sizes) {
            return send_data($sizes, 200);
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
    public function store(SizeStoreRequest $request)
    {
        $size = Size::create($request->all());
        if ($size) {
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
        $data = Size::findOrFail($id);
        return send_data($data, 200);
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
        $data = Size::findOrFail($id);
        $data->update($request->all());
        if ($data) {
            return send_msg('Data Update Success', true, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Size::findOrFail($id);
        $data->delete();
        return send_msg('Delete Success', true, 200);
    }


    public function multipleDelete(Request $request)
    {
        foreach ($request->all() as $iD) {
            $data = Size::findOrFail($iD);
            $data->delete();
        }
        return send_msg('Delete Success', true, 200);
    }
}
