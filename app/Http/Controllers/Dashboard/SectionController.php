<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CategoryStoreRequest;
use App\Http\Requests\Dashboard\CategoryUpdateRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class SectionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        $data['total_resources_count'] = Section::count();
        $data['categories'] = Section::paginate(20);
        return view('dashboardV2.sections.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['icons'] = config('icons.icons');
        return view('dashboardV2.sections.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = $request->all();
        // dd($data);
     /*   if ($request->hasFile('image')) {
            $image  = $request->file('image');
            $resize = Image::make($image)->resize(241, 165)->save();
            $data['image'] = $image->store('images/sections/banners');
        }*/
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/sections/images');
        }
        if (Section::create($data)) {
            return redirect(route('dashboard.sections.index'))->with('success', 'Section created.');
        }
        return back()->with('info', 'Section did not create.');
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
        if ($category = Section::find($id)) {
            $icons = config('icons.icons');
            return view('dashboardV2.sections.edit', compact('category' , 'icons'));
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
    public function update(CategoryUpdateRequest $request, $id)
    {
        $data = $request->all();
        $category = Section::find($id);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/sections/images');
        }

        if ($category->update($data)) {
            return redirect('dashboard/sections/index')->with('success', 'Item updated.');
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
        if ($category = Section::find($id)) {
            $category->delete();
            return redirect()->route('dashboard.sections.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }
}
