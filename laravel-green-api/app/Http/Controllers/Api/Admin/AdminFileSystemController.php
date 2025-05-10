<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminFileSystem;
use Illuminate\Http\Request;

class AdminFileSystemController extends Controller
{
    public function files(Request $request)
    {

        $limit = 30;
        $sort = "Desc";
        $type = "product";
        if (isset($request->limit)) $limit = $request->limit;
        if (isset($request->sort)) $sort = $request->sort;
        if (isset($request->type)) $type = $request->type;

        $files = AdminFileSystem::orderBy("id", $sort)->type($type)->paginate($limit);
        if ($files) {
            return send_data($files, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }


    public function product(Request $request)
    {
        if ($request->file('file')) {
            $path = 'uploads/products';
            $size = [450, 450];
            $saveImg = uploadImage($request->file('file'), $path, false, $size);
            $file = AdminFileSystem::create([
                'url' => $saveImg,
                'type' => "product",
            ]);
            return $file->url;
        }
    }

    public function category(Request $request)
    {
        if ($request->file('file')) {
            $path = 'uploads/categories';
            $size = [250, 120];
            $saveImg = uploadImage($request->file('file'), $path, false, $size);
            $file = AdminFileSystem::create([
                'url' => $saveImg,
                'type' => "category"
            ]);
            return $file->url;
        }
    }

    public function brand(Request $request)
    {
        if ($request->file('file')) {
            $path = 'uploads/brands';
            $size = [350, 350];
            $saveImg = uploadImage($request->file('file'), $path, false, $size);
            $file = AdminFileSystem::create([
                'url' => $saveImg,
                'type' => "brand"
            ]);
            return $file->url;
        }
    }

    public function slider(Request $request)
    {
        if ($request->file('file')) {
            $path = 'uploads/sliders';
            $size = [1440, 450];
            $saveImg = uploadImage($request->file('file'), $path, false, $size);
            $file = AdminFileSystem::create([
                'url' => $saveImg,
                'type' => "slider"
            ]);
            return $file->url;
        }
    }



    public function photoRemove(Request $request)
    {

        $file = AdminFileSystem::where('url', $request->photo)->first();
        if ($file) {
            $file->delete();
        }
        if (file_exists(public_path() . $request->photo)) {
            @unlink(public_path() . $request->photo);
        }
        return send_msg('Remove Success', true, 200);
    }
}
