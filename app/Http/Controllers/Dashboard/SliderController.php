<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\SliderStoreRequest;
use App\Http\Requests\Dashboard\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\createSliderRequest;
use Image;
use Alert;


class SliderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['counter_offset'] = request()->get('page' ,1) * 20 - 20;
        $data['sliders'] = Slider::paginate(20);
        return view('dashboardV2.sliders.index' ,$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboardV2.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(createSliderRequest $request)
    {
        
        $data = $request->all();
        $create = Slider::create($data);
        Alert::success('Your data has been saved', 'Done!')->persistent('Close');
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
        if ($slider = Slider::find($id)) {
            return view('dashboardV2.sliders.edit', compact('slider'));
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
    public function update(createSliderRequest $request, $id)
    {
        $data = $request->all();
        $slider = Slider::where('id',$id)->first();
        $slider->update($data);
        Alert::success('Your data has been updated', 'Done!')->persistent('Close');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if ($category = Slider::find($id)) {
            $category->delete();
            return redirect()->route('dashboard.sliders.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }
}
