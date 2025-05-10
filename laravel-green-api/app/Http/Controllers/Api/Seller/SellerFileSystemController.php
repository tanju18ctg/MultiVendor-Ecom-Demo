<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\SellerFileSystem;
use Illuminate\Http\Request;

class SellerFileSystemController extends Controller
{
    public function files(Request $request)
    {



        $limit = 30;
        $sort = "Desc";
        if (isset($request->limit)) $limit = $request->limit;
        if (isset($request->sort)) $sort = $request->sort;
        $files = auth('seller-api')->user()->files()->orderBy("id", $sort)->paginate($limit);
        if ($files) {
            return send_data($files, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }


    public function upload(Request $request)
    {
        if ($request->file('file')) {
            $path = 'uploads/seller/products';
            $size = [450, 450];
            $saveImg = uploadImage($request->file('file'), $path, false, $size);
            $file = SellerFileSystem::create([
                'seller_id' => $request->id,
                'url' => $saveImg,
            ]);
            return $file->url;
        }
    }


    public function photoRemove(Request $request)
    {

        $file = SellerFileSystem::where('url', $request->photo)->first();
        if ($file) {
            $file->delete();
        }
        if (file_exists(public_path() . $request->photo)) {
            @unlink(public_path() . $request->photo);
        }
        return send_msg('Remove Success', true, 200);
    }
}
