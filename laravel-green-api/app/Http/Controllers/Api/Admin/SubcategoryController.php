<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\subcategory\StoreRequest;
use App\Http\Requests\backend\subcategory\UpdateRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
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
        $category_id = Category::pluck('id')->first();
        if (isset($request->limit)) $limit = $request->limit;
        if (isset($request->status)) $status = $request->status;
        if (isset($request->category_id)) $category_id = $request->category_id;

        $subcategories = Subcategory::Status($status)->orderBy('id', 'desc')->where('category_id', $category_id)->paginate($limit);
        if ($subcategories) {

            return send_data($subcategories, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function subCatAll($catId)
    {
        $subcategories = Subcategory::Published()->where('category_id', $catId)->orderBy('name', 'Asc')->get();
        if ($subcategories) {
            return send_data($subcategories, 200);
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

        // dd($request->all());

        foreach ($request->name as $subcat) {
            Subcategory::create([
                'category_id' => $request->category_id,
                'name' => $subcat['name'],
                'slug' => Str::slug($subcat['name']),
                'status' => $subcat['status'],
            ]);
        }
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
        $subcategory = Subcategory::findOrFail($id);
        return send_data($subcategory, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $subcat = Subcategory::find($id);
        $request['slug'] = Str::slug($request->name);
        $subcat->update($request->all());
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
        $subcat = Subcategory::find($id);
        $subcat->delete();
        return send_msg('Delete Success', true, 200);
    }

    public function multipleDelete(Request $request)
    {
        foreach ($request->all() as $subcatId) {
            $subcat = Subcategory::findOrFail($subcatId);
            $subcat->delete();
        }
        return send_msg('Delete Success', true, 200);
    }
}
