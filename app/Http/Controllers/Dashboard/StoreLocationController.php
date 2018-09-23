<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreLocation;
use Mapper;

class StoreLocationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $locations = StoreLocation::all();
        Mapper::map(53.381128999999990000, -1.470085000000040000, ['marker' => false]);
        foreach ($locations as $key => $location) {

            if($key == 0){
                Mapper::informationWindow($location['latitude'], $location['longitude'], $location['address'], ['open' => true, 'maxWidth'=> 300, 'markers' => ['title' => $location['address']]]);
            }else{
                Mapper::informationWindow($location['latitude'], $location['longitude'], $location['address'], ['open' => true, 'maxWidth'=> 300, 'markers' => ['title' => $location['address']]]);
            }
        }

        return view('dashboardV2.store_locations.locations',compact('locations','locations'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('dashboardV2.store_locations.create');
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
        $createStoreLocation = StoreLocation::create($data);
        return redirect()->route('dashboard.storelocations.index');
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
    public function edit(StoreLocation $storelocation)
    {
        $data['location'] = $storelocation;
        return view('dashboardV2.store_locations.edit' ,$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, StoreLocation $storelocation)
    {
        $data = $request->all();
        $storelocation->update($data);
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
        $remove = StoreLocation::findOrFail($id);

        $remove->delete();
        return redirect()->route('dashboard.storelocations.index');
    }
}
