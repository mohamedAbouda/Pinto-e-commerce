<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandStoreRequest;
use App\Http\Requests\Dashboard\BrandUpdateRequest;
use App\Models\Brand;

class BrandController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['resources'] = Brand::orderBy('id' , 'DESC')->paginate(20);
        return view('dashboardV2.brand.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboardV2.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreRequest $request)
    {
        $resource = Brand::create($request->all());
        if ($resource) {
            alert()->success('Brand created successfully.', 'Success');
            return redirect()->back();
        }
        alert()->error('Something went wrong please try again !', 'Error');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('dashboardV2.brand.edit' , ['resource' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $input = $request->all();
        $image_full_path = public_path($brand->upload_distination.$brand->image);
        if (isset($input['image']) && $brand->image && file_exists($image_full_path)) {
            unlink($image_full_path);
        }
        $resource = $brand->update($input);
        if ($resource) {
            alert()->success('Brand updated successfully.', 'Success');
            return redirect()->back();
        }
        alert()->error('Something went wrong please try again !', 'Error');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $image_full_path = public_path($brand->upload_distination.$brand->image);
        if ($brand->image && file_exists($image_full_path)) {
            unlink($image_full_path);
        }
        $brand->delete();
        alert()->success('Brand deleted.', 'Success');
        return redirect()->back();
    }
}
