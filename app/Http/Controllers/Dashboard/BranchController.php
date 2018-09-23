<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BranchStoreRequest;
use App\Http\Requests\Dashboard\BranchUpdateRequest;
use App\Models\Branch;
use App\Models\Governorate;

class BranchController extends Controller
{
    protected $views_path ='dashboardV2.branches.';

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        $data['total_resources_count'] = Branch::count();
        $data['resources'] = Branch::with(['governorate'])->orderBy('id','DESC')->paginate(20);
        return view($this->views_path.'index',$data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $data['governorates'] = Governorate::pluck('name','id')->toArray();
        return view($this->views_path.'create',$data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(BranchStoreRequest $request)
    {
        $input = $request->all();
        if ($request->get('governorate_id') && !is_numeric($input['governorate_id'])) {
            $gov = Governorate::create(['name' => $input['governorate_id']]);
            $input['governorate_id'] = $gov->id;
        }
        if (Branch::create($input)) {
            alert()->success('Branch created.', 'Success');
            return redirect()->route('dashboard.branches.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Branch $branch) // named "deal" for resource route reasons ... don't judge
    {
        $data['governorates'] = Governorate::pluck('name','id')->toArray();
        $data['resource'] = $branch;
        return view($this->views_path.'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(BranchUpdateRequest $request, Branch $branch)
    {
        $input = $request->all();
        if ($request->get('governorate_id') && !is_numeric($input['governorate_id'])) {
            $gov = Governorate::create(['name' => $input['governorate_id']]);
            $input['governorate_id'] = $gov->id;
        }
        if ($branch->update($input)) {
            alert()->success('Branch updated.', 'Success');
            return redirect()->route('dashboard.branches.index');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        alert()->success('Product branch deleted.', 'Success');
        return redirect()->route('dashboard.branches.index');
    }

}
