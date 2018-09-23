<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\MerchantAdminCreateRequest;
use App\Http\Requests\Dashboard\MerchantAdminUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\MerchantAdmin;
use Auth;

class MerchantAdminController extends Controller
{
    protected $base_view_path = 'dashboardV2.merchant_admins.';

    public function index()
    {
        $data['merchant'] = Auth::guard('merchant')->user();
        $data['total_resources_count'] = MerchantAdmin::where('merchant_id',$data['merchant']->merchant_id)->count();
        $data['resources'] = MerchantAdmin::where('merchant_id',$data['merchant']->merchant_id)
        ->orderBy('id','DESC')->paginate(20);
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        return view($this->base_view_path . 'index',$data);
    }

    public function create()
    {
        $data['merchant'] = Auth::guard('merchant')->user();
        return view($this->base_view_path . 'create',$data);
    }

    public function store(MerchantAdminCreateRequest $request)
    {
        $merchant = Auth::guard('merchant')->user();
        $input = $request->all();
        $input['approved'] = 1;
        if(isset($input['password']) && $input['password']){
            $input['password'] = bcrypt($input['password']);
        }
        $input['merchant_id'] = $merchant->id;
        if (MerchantAdmin::create($input)) {
            alert()->success('Admin created successfully.', 'Success');
            return redirect()->back();
        }
        alert()->error('Something went wrong please try again.', 'Error');
        return redirect()->back();
    }

    public function edit(Merchant $admin)
    {
        $data['merchant'] = Auth::guard('merchant')->user();
        $data['resource'] = $admin;
        return view($this->base_view_path . 'edit',$data);
    }

    public function update(MerchantAdminUpdateRequest $request, Merchant $admin)
    {
        $merchant = Auth::guard('merchant')->user();
        $input = $request->all();
        if(isset($input['password']) && $input['password']){
            $input['password'] = bcrypt($input['password']);
        }
        if (isset($input['merchant_id']) && $input['merchant_id']) {
            unset($input['merchant_id']);
        }
        if ($admin->update($input)) {
            alert()->success('Admin updated successfully.', 'Success');
            return redirect()->back();
        }
        alert()->error('Something went wrong please try again.', 'Error');
        return redirect()->back();
    }

    public function show(Merchant $admin)
    {
        $data['merchant'] = Auth::guard('merchant')->user();
        $data['resource'] = $admin;
        return view($this->base_view_path . 'show',$data);
    }

    public function destroy(Merchant $admin)
    {
        $admin->delete();

        alert()->success('Admin deleted successfully.', 'Success');
        return redirect()->back();
    }
}
