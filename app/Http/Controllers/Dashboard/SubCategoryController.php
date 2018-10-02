<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SubCategoryStoreRequest;
use App\Http\Requests\Dashboard\SubCategoryUpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends BaseController
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
        $data['total_resources_count'] = SubCategory::count();
        $data['resources'] = SubCategory::orderBy('id' , 'DESC')->paginate(20);
        return view('dashboardV2.sub_categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::pluck('name' , 'id')->toArray();
        $data['icons'] = config('icons.icons');
        return view('dashboardV2.sub_categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryStoreRequest $request)
    {
        $data = $request->all();
        // dd($data);
        if (SubCategory::create($data)) {
            return redirect()->back()->with('success', 'category created.');
        }
        return redirect()->back()->withErrors(['error' => 'category wasn\'t created.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $data['categories'] = Category::pluck('name' , 'id')->toArray();
        $data['icons'] = config('icons.icons');
        $data['resource'] = $subCategory;
        return view('dashboardV2.sub_categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryUpdateRequest $request, SubCategory $subCategory)
    {
        $data = $request->all();
        if ($subCategory->update($data)) {
            return redirect()->back()->with('success', 'category updated.');
        }
        return redirect()->back()->withErrors(['error' => 'category wasn\'t updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->back()->with('success', 'Sub-category deleted.');
    }
}
