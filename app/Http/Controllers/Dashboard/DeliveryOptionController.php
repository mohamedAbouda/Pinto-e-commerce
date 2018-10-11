<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;

class DeliveryOptionController extends BaseController
{

    public function index()
    {
        $data['resources'] = ShippingMethod::paginate(20);
        $data['total_resources_count'] = ShippingMethod::count();
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        return view('dashboardV2.delivery_options.index', $data);
    }

    public function create()
    {
        return view('dashboardV2.delivery_options.add');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'cost' => 'min:0'
        ]);
        $data = $request->all();
        if (ShippingMethod::create($data)) {
            alert()->success('Shipping method option added.', 'Success');
            return redirect()->route('dashboard.delivery_options.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }

    public function edit($id)
    {
        if ($shipping_method = ShippingMethod::find($id)) {
            return view('dashboardV2.delivery_options.edit' , compact('shipping_method'));
        }
        return back()->with('info', 'Shipping method wasn\'t found !');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'cost' => 'min:0'
        ]);
        $data = $request->all();
        $shipping_method = ShippingMethod::find($id);

        if ($shipping_method->update($data)) {
            alert()->success('Shipping method updated.', 'Success');
            return redirect()->route('dashboard.delivery_options.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }

    public function destroy($id)
    {
        if ($shipping_method = ShippingMethod::find($id)) {
            $shipping_method->delete();
            alert()->success('Shipping method deleted.', 'Success');
            return redirect()->route('dashboard.delivery_options.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }
}
