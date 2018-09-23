<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CorporateDeal;
use App\Models\Merchant;
use App\Models\Product;
use Auth;

class CorporateDealController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $corporate_deals = CorporateDeal::with('firstProduct','secondProduct')->paginate(15);
        return view('dashboardV2.corporate_deals.index',compact('corporate_deals'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $products = Product::all();
        return view('dashboardV2.corporate_deals.create',compact('products'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['approved'] = 1;
        $create = CorporateDeal::create($data);
        return redirect()->route('dashboard.corporate_deals.index');
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
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $products = Product::all();
        $corporate_deal = CorporateDeal::where('id',$id)->with('firstProduct','secondProduct')->first();
        return view('dashboardV2.corporate_deals.edit',compact('corporate_deal','products'));
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
        $data = $request->all();
        $corporate_deal = CorporateDeal::where('id',$id)->first();
        $corporate_deal->update($data);
        return redirect()->route('dashboard.corporate_deals.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        if ($corporate_deal = CorporateDeal::find($id)) {
            $corporate_deal->delete();
            return redirect()->route('dashboard.corporate_deals.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }

    public function toggleStatus(Request $request)
    {
        $checkStatus = CorporateDeal::where('id',$request->input('id'))->first();
        if($checkStatus->approved == 0){
            $checkStatus->update(['approved'=>1]);
        }else{
            $checkStatus->update(['approved'=>0]);
        }

        return redirect()->back();
    }

    public function corporateDealNotActive()
    {
        $corporate_deals = CorporateDeal::where('approved',0)->with('firstProduct','secondProduct')->paginate(15);
        return view('dashboardV2.corporate_deals.index',compact('corporate_deals'));
    }

    public function corporateDealActive()
    {
        $corporate_deals = CorporateDeal::where('approved',1)->with('firstProduct','secondProduct')->paginate(15);
        return view('dashboardV2.corporate_deals.index',compact('corporate_deals'));
    }
}
