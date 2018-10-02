<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Term;
use App\TermFAQ;

class TermController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['term'] = Term::first();
        $data['terms_faq'] = TermFAQ::all();

        return view('dashboardV2.terms.index' ,$data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('dashboardV2.terms.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $delete = Term::where('id','!=',null)->delete();
        $term = Term::create([
            'description' => $request->input('body')
        ]);

        if ($request->get('faq')) {
            TermFAQ::where('id','!=',null)->delete();
            TermFAQ::insert($request->get('faq'));
        }

        return redirect()->route('dashboard.terms.index');
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
        $data['term'] = Term::first();
        $data['terms_faq'] = TermFAQ::all();

        return view('dashboardV2.terms.edit' ,$data);
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
        $updateTerm = Term::where('id',$id)->update([
            'description'=>$request->input('body')
        ]);
        if ($request->get('faq')) {
            TermFAQ::where('id','!=',null)->delete();
            TermFAQ::insert($request->get('faq'));
        }
        return redirect()->route('dashboard.terms.index');
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
