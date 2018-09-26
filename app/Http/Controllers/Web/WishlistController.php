<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WishList;
use Cart;
use Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $products = WishList::with('product.images','client')->where('client_id',Auth::guard('client')->id())->get();
        return view('site.wishlist.index')->with(['products'=>$products]);
    }


    public function delete(Request $request)
    {

        $delete = WishList::where('id',$request->input('id'))->delete();
        return $request->input('id');
    }

    public function deleteAll(Request $request)
    {

        $delete = WishList::where('client_id',Auth::guard('client')->id())->delete();
        return redirect()->back();
    }


    public function add(Request $request)
    {
        $data = $request->all();
        if(!Auth::guard('client')->check()){
            return response()->json([
                'error' => 'Please login to add products to your wish list.',
                'count' => 0
            ]);
        }

        $check = WishList::where('client_id',Auth::guard('client')->user()->id)
        ->where('product_id',$request->input('id'))->first();
        $count = 0;
        $message = "";

        if(!$check){
            $createWishList = WishList::create([
                'client_id' => Auth::guard('client')->id(),
                'product_id' => $request->input('id')
            ]);
            $count = WishList::where('client_id' ,Auth::guard('client')->id())->count();
            $message = 'Product Added to wish list.';
        }else{
            $count = WishList::where('client_id' ,Auth::guard('client')->id())->count();
            $message = 'This product already in wish list.';
        }

        return response()->json([
            'message' => $message,
            'count' => $count
        ]);
    }
}
