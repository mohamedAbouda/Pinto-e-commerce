<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\PolicyFAQ;

class PolicyController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['policy'] = Policy::first();
        $data['policy_faq'] = PolicyFAQ::all();

        return view('dashboardV2.policy.index' ,$data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('dashboardV2.policy.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $delete = Policy::where('id','!=',null)->delete();
        $policy = Policy::create([
            'description' => $request->input('body')
        ]);

        if ($request->get('faq')) {
            PolicyFAQ::where('id','!=',null)->delete();
            PolicyFAQ::insert($request->get('faq'));
        }

        return redirect()->route('dashboard.policy.index');
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
        $data['policy'] = Policy::first();
        $data['policy_faq'] = PolicyFAQ::all();

        return view('dashboardV2.policy.edit' ,$data);
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
        $updatePolicy = Policy::where('id',$id)->update([
            'description'=>$request->input('body')
        ]);
        if ($request->get('faq')) {
            PolicyFAQ::where('id','!=',null)->delete();
            PolicyFAQ::insert($request->get('faq'));
        }
        return redirect()->route('dashboard.policy.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
