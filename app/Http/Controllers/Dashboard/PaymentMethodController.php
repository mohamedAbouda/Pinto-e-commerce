<?php
namespace App\Http\Controllers\Dashboard;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentMethodController extends BaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['resources'] = PaymentMethod::paginate(20);
        $data['total_resources_count'] = PaymentMethod::count();
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        return view('dashboardV2.payment_methods.index', $data);
        return view('dashboard.paymentMethods.index', compact('paymentMethods'));
    }

    /**
    * Change availability of payment method (available to use or not).
    *
    * @param Request $request
    * @return JSON
    */
    public function availability(Request $request)
    {
        $data=$request->all();
        $paymentMethod=PaymentMethod::find($data['paymentMethodId']);
        $paymentMethod->availability=$data['availability'];
        $paymentMethod->update();
        $statusName=$data['availability']==0?'inactive':'active';
        return response()->json(array(
            'msg' => 'This payment became '.$statusName.' successfully.',
        ),200);
    }

    public function edit($type = 'PayPal')
    {

    }

    public function update(Request $request)
    {

    }
}
