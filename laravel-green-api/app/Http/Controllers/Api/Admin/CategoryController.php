<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CategoryUpdateRequest;
use App\Http\Requests\backend\StoreCategoryRequest;
use App\Models\Category;
use App\Models\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Ui\Presets\React;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(['subcats'])->Published()->orderBy('id', 'desc')->get();
        if ($categories) {

            return send_data($categories, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function categoryAll(Request $request){

        $limit = 10;
        $status = "active";
        if (isset($request->limit)) $limit = $request->limit;
        if (isset($request->status)) $status = $request->status;

        $categories = Category::Status($status)->orderBy('id', 'desc')->paginate($limit);
        if ($categories) {

            return send_data($categories, 200);
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
    public function store(StoreCategoryRequest $request)
    {
        // dd($request->all());
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status == true ? 'active' : 'inactive';
        // if ($request->file('image')) {
        //     $path = 'uploads/categories';
        //     $size = [250,120];
        //     $saveImg = uploadImage($request->file('image'),$path,$category->slug,$size);
        // }
        $category->image = $request->image;
        $category->save();
        return send_msg('Create Success',true, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
       return send_data($category, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $request['slug'] = Str::slug($request->name);
        $request['status'] = $request->status == true ? 'active' : 'inactive';
        $cat = Category::find($id);
        $cat->update($request->all());
        return send_msg('Update Success',true, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category = Category::findOrFail($id);
    //    @unlink(public_path().$category->image);
        $category->subcats()->delete();

    // $user->photos()->delete();
       $category->delete();
       return send_msg('Delete Success',true, 200);
    }

    public function multipleDelete(Request $request)
    {
        foreach ($request->all() as $catId) {
            $category = Category::findOrFail($catId);
            // @unlink(public_path().$category->image);
            $category->subcats()->delete();
            $category->delete();
        }
        return send_msg('Delete Success',true, 200);
    }



}
