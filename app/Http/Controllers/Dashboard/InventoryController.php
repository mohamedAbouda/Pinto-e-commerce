<?php
namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(20);
        return view('dashboard.inventory.index', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($product = Product::find($id)) {
            return view('dashboard.inventory.edit', compact('product'));
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
        $this->validate($request,['inventory'=>'required|integer']);
        $data = $request->all();
        $product = Product::find($id);
        if ($product->update(['inventory'=>$data['inventory']])) {
            return redirect('dashboard/inventory/index')->with('success', 'Item updated.');
        }
        return back()->with('info', 'Item did not update.');
    }

}
