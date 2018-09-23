<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\RedeemedGift;
use App\Http\Controllers\Controller;

class RedeemedGiftController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redeemedGifts = RedeemedGift::paginate(20);
        return view('dashboard.redeemed_gifts.index', compact('redeemedGifts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($redeemedGift = RedeemedGift::find($id)) {
            $redeemedGift->delete();
            return redirect()->route('dashboard.redeemed_gifts.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }

   

}
