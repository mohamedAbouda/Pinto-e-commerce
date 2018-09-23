<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Address;
use App\Models\Merchant;
use App\Models\Governorate;

class AdminController extends BaseController
{
    protected $base_view_path = 'dashboardV2.admins.';

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        $data['resources'] = User::paginate(20);
        $data['total_resources_count'] = User::count();
        return view($this->base_view_path . 'index',$data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view($this->base_view_path . 'create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CreateAdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $createUser = User::create($data);

        $role = Role::where('name', 'admin')->first();
        $createUser->attachRole($role);

        alert()->success('Admin created successfully.', 'Success');
        return redirect()->back();

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(User $admin)
    {
        $data['resource'] = $admin;
        return view($this->base_view_path . 'show',$data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(User $admin)
    {
        $data['resource'] = $admin;
        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateAdminRequest $request, User $admin)
    {
        $data = $request->all();
        if($request->input('password')){
            $data['password'] = bcrypt($data['password']);
        }
        $admin->update($data);

        alert()->success('Admin updated successfully.', 'Success');
        return redirect()->route('dashboard.admins.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $admin)
    {
        $admin->delete();
        alert()->success('Admin deleted successfully.', 'Success');
        return redirect()->route('dashboard.admins.index');
    }
}
