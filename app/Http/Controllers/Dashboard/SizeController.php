<?php
namespace App\Http\Controllers\Dashboard;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::paginate(20);
        return view('dashboardV2.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboardV2.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required']);
        $data = $request->all();
        if (Size::create($data)) {
            return redirect(route('dashboard.sizes.index'))->with('success', 'Size created.');
        }
        return back()->with('info', 'Size did not create.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($size = Size::find($id)) {
            return view('dashboardV2.sizes.edit', compact('size'));
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
    public function update(Request $request, $id)
    {
        $this->validate($request,['name'=>'required']);
        $data = $request->all();
        $size = Size::find($id);
        if ($size->update($data)) {
            return redirect('dashboard/sizes/index')->with('success', 'Item updated.');
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
        if ($size = Size::find($id)) {
            $size->delete();
            return redirect()->route('dashboard.sizes.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }
}
