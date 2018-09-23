<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CollectionStoreRequest;
use App\Http\Requests\Dashboard\CollectionUpdateRequest;
use App\Models\Product;
use App\Models\Collection;

class CollectionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Collection::paginate(10);
        return view('dashboard.collection.index' , compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.collection.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionStoreRequest $request)
    {
        $resource = Collection::create($request->all());
        if ($resource) {
            return redirect()->back()->with('success' , "Collection added successfully.");
        }
        return redirect()->back()->withErrors(["Something went wrong ! please try again."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        // $data['collection_products_ids'] = $collection->products()->get()
        // ->pluck('id')->toArray();
        $data['products'] = $collection->products()->orderBy('id' , 'DESC')->paginate(10);
        $data['collection'] = $collection;
        return view('dashboard.collection.products' , $data);
    }

    public function product(Product $product)
    {
        $data['product'] = $product;
        $data['resources'] = Collection::get();
        $data['collection_products_ids'] = $product->collection->pluck('id')
        ->toArray();
        $html = view('dashboard.collection.parts.addProductToCollectionsTable' , $data)->render();
        return response()->json([
            'html' => $html
        ]);
    }

    public function productCollection(Collection $collection , Product $product)
    {
        $exists = $collection->products()->find($product->id);
        if ($exists) {
            $collection->products()->detach($product->id);
        }else{
            $collection->products()->attach($product->id);
        }
        return response()->json([
            'success' => 1
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        return view('dashboard.collection.form' , ['resource' => $collection]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CollectionUpdateRequest $request, Collection $collection)
    {
        $resource = $collection->patch($request->all());
        if ($resource) {
            return redirect()->back()->with('success' , "Collection edited successfully.");
        }
        return redirect()->back()->withErrors(["Something went wrong ! please try again."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        if ($collection->image) {
            $path_to_file = storage_path('app/'.$collection->image);
            if (file_exists($path_to_file)) {
                unlink($path_to_file);
            }
        }
        if ($collection->banner_text) {
            $path_to_file = storage_path('app/'.$collection->banner_text);
            if (file_exists($path_to_file)) {
                unlink($path_to_file);
            }
        }
        $collection->delete();
        return redirect()->back()->with('success', 'Collection deleted.');
    }
}
