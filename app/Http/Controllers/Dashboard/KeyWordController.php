<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KeyWord;
use App\Models\Product;

class KeyWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key_words = KeyWord::paginate(10);
        return view('dashboardV2.key_words.index',compact('key_words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboardV2.key_words.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $count = 0;
        $create = KeyWord::create($data);
        $myArray = explode(',', $request->input('text'));
        $product = Product::where('id',$request->input('product_id'))->first();
         $categoryKeys = explode(',', $product->subcategory->category->keyWord->text);
        foreach ($myArray as $key) {
           if(in_array($key, $categoryKeys)){
            $count++;
           }
        }
        if($count >= round(count($myArray)/4)){
            $product->update(['match_keys'=>1]);
        }else{
            $product->update(['match_keys'=>0]);
        }
        $updateProduct = Product::where('id',$request->input('product_id'))->update([
            'key_word_id'=>$create->id,
        ]);
        $productId = $request->input('product_id');
        return view('dashboardV2.products.productImages',compact('productId'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $key_word = KeyWord::findOrFail($id);
        return view('dashboardV2.key_words.edit',compact('key_word'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = KeyWord::where('id',$id)->update([
            'text'=>$request->input('text'),
        ]);
         return redirect()->route('dashboard.key_words.index')->with('success', 'Item updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if ($key = KeyWord::find($id)) {
            $key->delete();
            return redirect()->route('dashboard.key_words.index')->with('success', 'Item deleted.');
        }
        return back()->with('info', 'Item did not delete!');
    }
}
