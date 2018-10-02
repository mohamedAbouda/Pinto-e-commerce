<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AboutRequest;
use App\Models\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::first();
        return view('dashboardV2.about.index')->with('about',$about);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['about'] = About::first();
        return view('dashboardV2.about.create' ,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutRequest $request)
    {
        $input = $request->all();

        $about = About::first();
        alert()->success('Updated successfully.', 'Success');

        if ($about) {
            $about = $about->update($input);
            return redirect()->route('dashboard.about.index');
        }
        $about = About::create($input);
        return redirect()->route('dashboard.about.index');
    }
}
