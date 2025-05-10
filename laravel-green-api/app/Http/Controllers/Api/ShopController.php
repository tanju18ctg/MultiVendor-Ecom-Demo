<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function products()
    {

        $products = Product::with(['category'])->latest()->published()->paginate(20);
        if ($products) {
            return send_data($products, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function allCategories()
    {

        $categories = Category::with(['products'])->latest()->published()->get();
        if ($categories) {
            return send_data($categories, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function allBrands()
    {
        $brands = Brand::with(['products'])->latest()->published()->get();
        if ($brands) {
            return send_data($brands, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }

    public function shopSidebar()
    {
        $categories = Category::with(['products'])->latest()->published()->get();
        $brands = Brand::with(['products'])->latest()->published()->get();

        // $offer_price = Product::published()->whereNull('offer_price')->get();

        // if ($offer_price) {
        //     return $offer_price;
        // }else{
        //     return 'nulll not founds..!';
        // }

        // die()

        $min_price = Product::published()->min('price');
        $max_price = Product::published()->max('price');

        // $data = array(

        // );

        return response()->json(
            [
                'status' => true,
                'data' => [

                    'categories' => $categories,
                    'brands' => $brands,
                    'price' => [
                        'min_price' => $min_price,
                        'max_price' => $max_price
                    ]
                ]
            ],
            200
        );
    }


    public function shopFilter(Request $request)
    {
        // dd($request->all());
        // die();
        $data = $request->all();
        // $products = Product::query()->published();

        if ($request->brand !== null || $request->category !== null || $request->price !== '-') {

            if ($request->category !== null) {
                $slugs = explode(',', $data['category']);
                $catIds = Category::whereIn('slug', $slugs)->pluck('id')->toArray();
                $products = Product::whereIn('category_id', $catIds)->published()->paginate(12);
            }

            // brand wise products
            if ($request->brand !== null) {
                $slugs = explode(',', $data['brand']);
                $brandIds = Brand::whereIn('slug', $slugs)->pluck('id')->toArray();
                $products = Product::whereIn('brand_id', $brandIds)->published()->paginate(12);
            }

            // price range product
            if ($request->price !== '-') {
                $price = explode('-', $data['price']);
                $min = $price['0'];
                $max = $price['1'];
                $products = Product::whereBetween('price', [$min, $max])->published()->paginate(12);
            }
        } else {
            $products = Product::with(['category'])->latest()->paginate(12);
        }
        return send_data($products, 200);
    }
}
