<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DiscountStoreRequest;
use App\Http\Requests\Dashboard\DiscountUpdateRequest;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Merchant;
use Carbon\Carbon;
use Auth;

class DiscountController extends BaseController
{
    protected $views_path ='dashboardV2.discounts.';
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;

        $products = Product::pluck('id')->toArray();

        $data['total_resources_count'] = Discount::whereIn('product_id' ,$products)->count();
        $data['resources'] = Discount::whereIn('product_id' ,$products)->orderBy('id','DESC')->paginate(20);

        return view($this->views_path.'index',$data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $discount_ids = Discount::where('active',1)->pluck('product_id')->toArray();
        $data['products'] = Product::whereNotIn('id',$discount_ids)->pluck('name','id')->toArray();

        return view($this->views_path.'create',$data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(DiscountStoreRequest $request)
    {
        $input = $request->all();

        $from = Carbon::parse($input['activation_start']);
        $to = Carbon::parse($input['activation_end']);
        if ($from->gt($to)) {
            alert()->error('Validation error.' , 'Error');
            return redirect()->back()->withErrors(['activation_start' => 'Activation start should be less than activation end date.']);
        }

        if (!isset($input['active'])) {
            $input['active'] = 0;
        }

        if (Discount::create($input)) {
            alert()->success('Product offer created.', 'Success');
            return redirect()->route('dashboard.offers.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Discount $discount)
    {
        // $data['products'] = $discount->products()->orderBy('id' , 'DESC')->paginate(10);
        // $data['discount'] = $discount;
        // return view('dashboard.discount.products' , $data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Discount $offer) // named "deal" for resource route reasons ... don't judge
    {
        $data['products'] = Product::pluck('name','id')->toArray();
        $data['resource'] = $offer;
        return view($this->views_path.'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(DiscountUpdateRequest $request, Discount $offer)
    {
        $input = $request->all();

        $from = Carbon::parse($input['activation_start']);
        $to = Carbon::parse($input['activation_end']);
        if ($from->gt($to)) {
            alert()->error('Validation error.' , 'Error');
            return redirect()->back()->withErrors(['activation_start' => 'Activation start should be less than activation end date.']);
        }

        $input['activation_start'] = $from->toDateTimeString();
        $input['activation_end'] = $to->toDateTimeString();

        if ($offer->update($input)) {
            alert()->success('Product offer updated.', 'Success');
            return redirect()->route('dashboard.offers.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Discount $offer)
    {
        $offer->delete();
        alert()->success('Product offer deleted.', 'Success');
        return redirect()->route('dashboard.offers.index');
    }

    /**
    * Toggle the boolean 'active' field in an offer
    *
    * @param  Discount $offer
    * @return \Illuminate\Http\Response
    */
    public function toggleActivation(Discount $offer)
    {
        $offer->active = ($offer->active === 1) ? 0 : 1;
        $offer->save();
        alert()->success('Product offer activation status changed.', 'Success');
        return redirect()->route('dashboard.offers.index');
    }
}
