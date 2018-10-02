<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Product;

class CompareController extends Controller
{
    public function add(Request $request)
    {
    	 $data = $request->all();
         $count = 0;
        
    	 if(!Session::get('compareSession')){
    	 		Session::push('compareSession', $data['id']);
                 $count = count(Session::get('compareSession'));
    	 	return ['Item has been added.',$count];
    	 }
    	 if($data['id'] == in_array($data['id'], Session::get('compareSession'))){
             $count = count(Session::get('compareSession'));
    	 	return ['You Added this item before',$count];
    	 }else{
    	 	Session::push('compareSession', $data['id']);
             $count = count(Session::get('compareSession'));
    	 	return ['Item has been added.',$count];
    	 }
    	 
    	 
    }

    public function index()
    {		
    	 if(!Session::get('compareSession')){
    	 	$products = '';
    	 }else{
    	 $products = Product::with('images','orderProducts','stocks')->whereIn('id',Session::get('compareSession'))->get();
    	}
    	
    	return view('site.compare.index')->with('products',$products);
    }

    public function delete(Request $request)
    {
    	session()->forget($request->input('id'));
    	
    	$newArray = [];
    	foreach (Session::get('compareSession') as $value) {
    		if($value != $request->input('id')){
    			array_push($newArray,$value);
    		}
    	}
    	Session::forget('compareSession');
    	foreach($newArray as $value){
    		Session::push('compareSession', $value);
    	}
    	return Session::get('compareSession');
    	return $request->input('id');
    }
}
