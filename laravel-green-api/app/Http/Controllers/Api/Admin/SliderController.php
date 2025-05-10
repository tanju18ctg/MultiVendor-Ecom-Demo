<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\slider\SliderStoreRequest;
use App\Http\Requests\backend\slider\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
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

        $data = Slider::status($status)->orderBy('id', 'desc')->paginate($limit);
        if ($data) {

            return send_data($data, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function SliderAll()
    {
        $data = Slider::published()->orderBy('name', 'Asc')->get();
        if ($data) {

            return send_data($data, 200);
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
    public function store(SliderStoreRequest $request)
    {
        Slider::create($request->all());
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
        $data = Slider::findOrFail($id);
        return send_data($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUpdateRequest $request, $id)
    {
        $data = Slider::find($id);
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
        $data = Slider::findOrFail($id);
        $data->delete();
        return send_msg('Delete Success', true, 200);
    }



    public function multipleDelete(Request $request)
    {
        foreach ($request->all() as $bId) {
            $data = Slider::findOrFail($bId);
            $data->delete();
        }
        return send_msg('Delete Success', true, 200);
    }
}
