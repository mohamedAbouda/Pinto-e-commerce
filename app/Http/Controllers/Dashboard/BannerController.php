<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BannerCreateRequest;
use App\Http\Requests\Dashboard\BannerUpdateRequest;
use App\Models\Banner;

class BannerController extends BaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['counter_offset'] = request()->get('page' ,1) * 20 - 20;
        $data['resources'] = Banner::paginate(20);
        return view('dashboardV2.banners.index' ,$data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('dashboardV2.banners.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(BannerCreateRequest $request)
    {
        $data = $request->all();
        $data['position'] = implode(',', $data['position']);
        $create = Banner::create($data);
        alert()->success('Banner created successfully.', 'Success');

        return redirect()->back();
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        if ($resource = Banner::find($id)) {
            return view('dashboardV2.banners.edit', compact('resource'));
        }

        alert()->error('Not found.', 'Error');
        return back();
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function update(BannerUpdateRequest $request, Banner $banner)
    {
        $data = $request->all();
        $data['position'] = implode(',', $data['position']);
        $banner->update($data);
        alert()->success('Banner updated successfully.', 'Success');

        return redirect()->back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Banner $banner)
    {
        $image_full_path = public_path($banner->upload_distination.$banner->image);
        if ($banner->image && file_exists($image_full_path)) {
            unlink($image_full_path);
        }
        $banner->delete();
        alert()->success('Deleted.', 'Success');

        return redirect()->route('dashboard.banners.index');
    }
}
