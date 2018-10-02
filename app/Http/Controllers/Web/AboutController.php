<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $about = About::first();
       if (!$about) {
           $about = '';
       }
       return view('web.aboutus.about')->with(['about' => $about]);
    }
}
