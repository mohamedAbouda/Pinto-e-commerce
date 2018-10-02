<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;

class CouponController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['resources'] = Coupon::orderBy('created_at' , 'DESC')->paginate(20);
        return view('dashboard.coupons.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::create($request->all());
        if ($coupon) {
            return redirect()->back()->with('success', 'New coupon added successfully');
        }
        return redirect()->back()->withErrors(["Something went wrong ! please try again."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('dashboard.coupons.show' , ['resource' => $coupon]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('dashboard.coupons.edit' , ['resource' => $coupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $coupon->update($request->all());
        return redirect()->back()->with('success', 'Coupon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('success', 'Coupon deleted.');
    }

    /**
     * Generate new unique code
     * @return \Illuminate\Http\Response
     */
    public function generate()
    {
        $code = str_random(16);
        while(Coupon::where('code' , $code)->first()) //better be safe than sowwy :3
        {
            $code = str_random(16);
        }
        return response()->json([
            'code' => $code
        ]);
    }
}
