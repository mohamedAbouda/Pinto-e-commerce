<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\AddressClient;
use App\Models\Address;
use DB;

class UserController extends Controller
{
    protected $mainRedirect = 'dashboardV2.users.';
    public function index()
    {
        $users =Client::paginate(10);

        return view($this->mainRedirect . 'index')->with('users', $users);
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
    public function store(Request $request)
    {
        $data = $request->all();
        $data['valid'] = 1;

        $user = Client::create($data);

        if ($user && $request->has('addresses')) {
            foreach ($data['addresses'] as $address) {
                if ((isset($address['address']) && $address['address']) || (isset($address['city']) && $address['city'])) {
                    $address = Address::create($address);
                    AddressClient::create([
                        'client_id' => $user->id,
                        'address_id' => $address->id,
                    ]);
                }
            }
        }

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Client::where('id',$id)->with('addresses')->first();

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
        $user = Client::where('id',$id)->with('addresses')->first();

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
        $user = Client::where('id',$id)->first();

        if ($request->has('addresses')) {
            foreach ($data['addresses'] as $address) {
                DB::table('addresses')->where('id' ,$address['id'])->update([
                    'address' => $address['address'],
                    'city' => $address['city'],
                ]);
            }
        }

        $user->update($data);

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
        $User = Client::findOrFail($id);

        $User->delete();
        return redirect()->route('dashboard.users.index');
    }

    public function statusToggle(Request $request)
    {
         $user = Client::where('id',$request->input('user_id'))->first();
        if($user->valid == 1){
            $user->update([
                'valid'=>0,
            ]);
        }else{
            $user->update([
                'valid'=>1,
            ]);
        }

        return redirect()->back();
    }

    public function approvedUsers($status)
    {
        if($status == 'approved'){
            $users =Client::where('valid',1)->paginate(10);
        }else{
            $users =Client::where('valid',0)->paginate(10);
        }
        return view($this->mainRedirect . 'index')->with('users', $users);

    }
}
