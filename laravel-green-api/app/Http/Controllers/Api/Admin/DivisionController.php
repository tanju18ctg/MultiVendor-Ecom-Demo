<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 10;
        if (isset($request->limit)) $limit = $request->limit;

        $data = Division::with(['districts'])->orderBy('name', 'asc')->paginate($limit);
        if ($data) {
            return send_data($data, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function districtList($id)
    {

        $division = Division::find($id);
        $data = $division->districts()->get();
        return send_data($data, 200);
    }

    public function divisonAll()
    {
        $data = Division::all();
        return send_data($data, 200);
    }

    public function districtListPaginate($id)
    {
        $division = Division::find($id);
        $data = $division->districts()->paginate(12);
        return send_data($data, 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
