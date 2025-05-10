<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Subcategory;
use Dotenv\Parser\Value;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function slider()
    {
        $slider = Slider::latest()->published()->take(3)->get();
        if ($slider) {
            return send_data($slider, 200);
        }else {
            return send_msg('Opps..! No Data Found',false, 404);
        }
    }

    public function categoryList()
    {
        $categories = Category::with(['subcategories','products'])->orderBy('name', 'ASC')->published()->take(15)->get();
        if ($categories) {
            return send_data($categories, 200);
        }else {
            return send_msg('Opps..! No Data Found',false, 404);
        }
    }

    public function subCatList()
    {
        $subcategories = Subcategory::orderBy('name', 'ASC')->published()->take(10)->get();
        if ($subcategories) {
            return send_data($subcategories, 200);
        }else {
            return send_msg('Opps..! No Data Found',false, 404);
        }
    }



    public function saleProducts()
    {
        $products = Product::with(['category'])->latest()->published()->Saleproduct()->take(15)->get();
        if ($products) {
            return send_data($products, 200);
        }else {
            return send_msg('Opps..! No Data Found',false, 404);
        }
    }

    public function conditionProduct($condition)
    {
        $products = Product::with(['category'])->latest()->published()->conditionProduct($condition)->take(10)->get();
        if (count($products) >= 1) {

            return response()->json(['condition' => $products->pluck('conditions')->first(), 'status' => true, 'data' => $products]);
            // return send_data($products->pluck('conditions')->first(), 200);
        } else {
            return send_msg('Opps..! No Data Found',false, 404);
        }
    }


    public function singleProduct($p_slug)
    {
        $products =  Product::with(['category'])->SlugProduct($p_slug)->published()->first();
        if ($products) {
            return send_data($products, 200);
        } else {
            return send_msg('Opps..! No Data Found',false, 404);
        }
    }
}
