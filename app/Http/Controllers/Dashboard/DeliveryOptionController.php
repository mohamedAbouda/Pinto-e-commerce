<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\DeliveryOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryOptionController extends BaseController
{

    public function index()
    {
        $data['resources'] = DeliveryOption::paginate(20);
        $data['total_resources_count'] = DeliveryOption::count();
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        return view('dashboardV2.delivery_options.index', $data);
        return view('dashboard.deliveryOptions.index', compact('deliveryOptions'));
    }

    public function create()
    {
        return view('dashboardV2.delivery_options.add');
        return view('dashboard.deliveryOptions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'icon'=>'image',
            'price' => 'min:0'
        ]);
        $data = $request->all();
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons/deliveryOptions');
        }
        if (DeliveryOption::create($data)) {
            alert()->success('Delivery option added.', 'Success');
            return redirect()->route('dashboard.delivery_options.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }

    public function edit($id)
    {
        if ($deliveryOption = DeliveryOption::find($id)) {
            // $countries=[['id'=>1,'name'=>'EGY']];
            return view('dashboardV2.delivery_options.edit' , compact('deliveryOption'));
            return view('dashboard.deliveryOptions.edit', compact('deliveryOption'));
        }
        return back()->with('info', 'Delivery option wasn\'t found !');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'icon'=>'image',
            'price' => 'min:0'
        ]);
        $data = $request->all();
        $customer = DeliveryOption::find($id);
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons/deliveryOptions');
        }
        if ($customer->update($data)) {
            alert()->success('Delivery option updated.', 'Success');
            return redirect()->route('dashboard.delivery_options.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }

    public function destroy($id)
    {
        if ($customer = DeliveryOption::find($id)) {
            $customer->delete();
            alert()->success('Delivery option deleted.', 'Success');
            return redirect()->route('dashboard.delivery_options.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }
}
