<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\SocialMediaStoreRequest;
use App\Http\Requests\Dashboard\SocialMediaUpdateRequest;
use App\Models\SocialMedia;
use App\Http\Controllers\Controller;

class SocialMediaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialmedias = SocialMedia::paginate(20);
        return view('dashboard.socialmedias.index', compact('socialmedias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.socialmedias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialMediaStoreRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('images/socialmedias');
        }
        if (SocialMedia::create($data)) {
            return redirect(route('dashboard.socialmedias.index'))->with('success', 'SocialMedia created.');
        }
        return back()->with('info', 'SocialMedia did not create.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($socialmedia = SocialMedia::find($id)) {
            return view('dashboard.socialmedias.edit', compact('socialmedia'));
        }
        return back()->with('info', 'Item did not found in database.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialMediaUpdateRequest $request, $id)
    {
        $data = $request->all();
        $socialmedia = SocialMedia::find($id);
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('images/socialmedias');
        }
        if ($socialmedia->update($data)) {
            return redirect('dashboard/socialmedias/index')->with('success', 'Item updated.');
        }
        return back()->with('info', 'Item did not update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($socialmedia = SocialMedia::find($id)) {
            $socialmedia->delete();
            return redirect()->route('dashboard.socialmedias.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }
}
