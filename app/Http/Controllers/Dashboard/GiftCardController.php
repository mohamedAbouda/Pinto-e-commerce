<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\GiftCardStoreRequest;
use App\Models\GiftCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Merchant;
class GiftCardController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         if(Auth::guard('merchant')->check()){
                $gift_cards = GiftCard::where('merchant_id',Auth::guard('merchant')->user()->merchant_id)->paginate(20);
            }else{
                 $gift_cards = GiftCard::paginate(20);
            }
        return view('dashboardV2.gift_cards.index', compact('gift_cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = str_random(7);
        return view('dashboardV2.gift_cards.create')->with(['code'=>$code]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GiftCardStoreRequest $request)
    {
        $data = $request->all();
        $data['code'] = str_random(6);

        if(Auth::guard('merchant')->check()){
            $data['merchant_id'] = Auth::guard('merchant')->user()->merchant_id;
        }
        $data['is_active'] = 1;
        $create = GiftCard::create($data);
        if ($create) {
            return redirect()->back()->with('success' , "Gift Card added successfully.");
        }
        return redirect()->back()->withErrors(["Something went wrong ! please try again."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($gift = GiftCard::find($id)) {
            return view('dashboardV2.gift_cards.edit', compact('gift'));
        }
        return back()->with('info', 'Item did not found in database.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,GiftCard $gift_card)
    {
        $data = $request->all();
        //$gift = GiftCard::find($id);
        $gift_card->update($data);
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($gift = GiftCard::find($id)) {
            $gift->delete();
            return redirect()->route('dashboard.gifts.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }

    public function listAll()
    {
        $merchants = Merchant::get();
        $gift_cards = GiftCard::paginate(10);
        return view('dashboardV2.gift_cards.list', compact('gift_cards','merchants'));
    }
    public function searchMerchantGiftCards(Request $request)
    {
         $merchants = Merchant::get();
        $gift_cards = GiftCard::where('merchant_id',$request->input('merchant_id'))->paginate(10);
        return view('dashboardV2.gift_cards.list', compact('gift_cards','merchants'));
    }

     public function changeStatus(Request $request)
    {
        if($request->input('gift_id')){
            $checkGiftCard = GiftCard::where('id',$request->input('gift_id'))->first();
            if($checkGiftCard->is_active == 1){
                $checkGiftCard->update(['is_active'=>0]);
            }else{
                $checkGiftCard->update(['is_active'=>1]);
            }
        }

        return redirect()->back();
    }
}
