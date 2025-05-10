<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist = Auth::guard('user-api')->user()->wishlistProduct()->get();
        if ($wishlist) {
            return send_data($wishlist, 200);
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
    public function store(Request $request)
    {


        $user = Auth::guard('user-api')->user();
        $wishlistProduct = $user->wishlistProduct()->where('product_id', $request->product_id)->count();
        if ($wishlistProduct == 0) {
            $user->wishlistProduct()->attach($request->product_id);
            return send_msg('Product added in wishlist', true, 200);
        } else {
            $user->wishlistProduct()->detach($request->product_id);
            return send_msg('Product remove from wishlist', false, 200);
        }

        // Wishlist::create([
        //     'user_id' => Auth::guard('user-api')->user()->id,
        //     'product_id' => $request->product_id
        // ]);

        // return $this->index();
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
        $user = Auth::guard('user-api')->user();
        $wishlistProduct = $user->wishlistProduct()->where('product_id', $id)->count();

        if ($wishlistProduct > 0) {
            $user->wishlistProduct()->detach($id);
            return send_msg('Product Remove Success', true, 200);
        } else {
            return send_msg('Opps..! No Data Found', false, 404);
        }
    }
}
