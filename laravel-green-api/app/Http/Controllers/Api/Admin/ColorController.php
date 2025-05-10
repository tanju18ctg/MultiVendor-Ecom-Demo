<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\color\ColorStoreRequest;
use App\Http\Requests\backend\color\ColorUpdateRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::Published()->orderBy('name', 'Asc')->get();
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

        $colors = Color::Status($status)->orderBy('id', 'desc')->paginate($limit);
        if ($colors) {
            return send_data($colors, 200);
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
    public function store(ColorStoreRequest $request)
    {

        $size = Color::create($request->all());
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
        $color = Color::findOrFail($id);
        return send_data($color, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ColorUpdateRequest $request, $id)
    {
        $size = Color::findOrFail($id);
        $size->update($request->all());
        if ($size) {
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
        $data = Color::findOrFail($id);
        $data->delete();
        return send_msg('Delete Success',true, 200);
    }

    public function multipleDelete(Request $request)
    {
        foreach ($request->all() as $iD) {
            $data = Color::findOrFail($iD);
            $data->delete();
        }
        return send_msg('Delete Success',true, 200);
    }
}
