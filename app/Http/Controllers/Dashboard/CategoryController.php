<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CategoryStoreRequest;
use App\Http\Requests\Dashboard\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\Models\KeyWord;

class CategoryController extends BaseController
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
        $data['total_resources_count'] = Category::count();
        $data['categories'] = Category::orderBy('id' ,'DESC')->paginate(20);
        return view('dashboardV2.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['icons'] = config('icons.icons');
        return view('dashboardV2.categories.create', $data);
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

         $createKey = KeyWord::create($data);
         $data['key_word_id'] = $createKey->id;

        if (Category::create($data)) {
            return redirect(route('dashboard.categories.index'))->with('success', 'Section created.');
        }
        return back()->with('info', 'Category did not create.');
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
        if ($category = Category::with('keyWord')->where('id',$id)->first()) {
            // $icons = config('icons.icons');
            return view('dashboardV2.categories.edit', compact('category'));
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
        $category = Category::find($id);
        if ($request->hasFile('banner')) {
            $image  = $request->file('banner');
            $resize = Image::make($image)->resize(241, 165)->save();
            $data['banner'] = $image->store('images/categories/banners');
        }
        $keyWord = $category->keyWord->update($data);
        // if ($request->hasFile('icon')) {
        //     $data['icon'] = $request->file('icon')->store('images/categories/icons');
        // }
        if ($category->update($data)) {
            return redirect('dashboard/categories/index')->with('success', 'Item updated.');
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
        if ($category = Category::find($id)) {
            $category->delete();
            return redirect()->route('dashboard.categories.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }
}
