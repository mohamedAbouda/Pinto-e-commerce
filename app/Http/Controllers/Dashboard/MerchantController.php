<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\MerchantAdmin;
use App\Models\Address;
use Mail;
use App\Http\Requests\Dashboard\CreateMerchantRequest;

class MerchantController extends Controller
{
    protected $mainRedirect = 'dashboardV2.merchants.';

    public function index()
    {
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        $data['total_resources_count'] = Merchant::count();
        $data['merchants'] = Merchant::paginate(20);
        return view($this->mainRedirect . 'index' ,$data);
    }
    public function approvedMerchants()
    {
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        $data['total_resources_count'] = Merchant::where('approved',1)->count();
        $data['merchants'] = Merchant::where('approved',1)->paginate(10);
        return view($this->mainRedirect . 'index' ,$data);
    }
    public function disapprovedMerchants($value='')
    {
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        $data['total_resources_count'] = Merchant::where('approved',0)->count();
        $data['merchants'] = Merchant::where('approved',0)->paginate(10);
        return view($this->mainRedirect . 'index' ,$data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view($this->mainRedirect . 'create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CreateMerchantRequest $request)
    {
        $data = $request->all();
        $createAddress = Address::create($data);
        $data['address_id'] = $createAddress->id;
        $data['password'] = bcrypt($request->input('password'));
        $createMerchant = Merchant::create($data);

        $data['merchant_id'] = $createMerchant->id;
        $data['primary'] = 1;
        MerchantAdmin::create($data);

        return redirect()->route('dashboard.merchants.index');

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $user = Merchant::where('id',$id)->with('address')->with('merchantAdmins')->first();
        return view($this->mainRedirect . 'show')->with(['user'=>$user]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user = Merchant::findOrFail($id);

        return view($this->mainRedirect . 'edit')->with(['user'=>$user]);
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

        $updateAddress = Address::where('id',$request->input('addressId'))->first();
        if (!$updateAddress) {
            $address = Address::create($data);
            $data['address_id'] = $address->id;
        }else{
            $updateAddress->update($data);
        }

        if($request->input('password')){
            $data['password'] = bcrypt($request->input('password'));
        }
        $updateMerchant = Merchant::where('id',$id)->first();
        $updateMerchant->update($data);

        if ($request->has('password')) {
            $merchant_data = $request->only(['password' ,'email']);
            $merchant_data['password'] = bcrypt($merchant_data['password']);
            MerchantAdmin::where('merchant_id' ,$id)->where('primary' ,1)->update($merchant_data);
        }        

        alert()->success('Data Updated successfully.', 'Success');
        return redirect()->back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $Merchant = Merchant::findOrFail($id);

        $Merchant->delete();
        return redirect()->route('dashboard.merchants.index');
    }

    public function statusToggle(Request $request)
    {
        $merchant = Merchant::where('id',$request->input('merchant_id'))->first();
        $messageSend = '';
        if($merchant->approved == 1){
            $merchant->update([
                'approved'=>0,
            ]);
            $messageSend = 'You have disapproved';
        }else{
            $merchant->update([
                'approved'=>1,
            ]);
            $messageSend = 'You have approved';

        }
        $email = $merchant->email;
        $messa = [
            'email' => $email,
            'messageSend'=>$messageSend,
        ];

        Mail::send('mail.status', $messa, function ($message) use ($email)
        {
            $message->subject(' Alashank Application');
            $message->to($email, $name = null);
        });

        return redirect()->back();
    }
}
