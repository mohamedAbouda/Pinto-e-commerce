<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\About;
use App\Models\Policy;
use App\Models\Term;

class ContactController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $contact = Contact::first();
        return view('site.contact.index')->with(['contact' => $contact]);
    }

    public function submit(Request $request)
    {
        $data = $request->all();
        $save = ContactMessage::create($data);
        alert()->success('Message Sent', '');
        return redirect()->back();
    }

    public function about()
    {
        $about = About::first();
        return view('site.about.index',compact('about'));
    }

    public function terms()
    {
        $terms = Term::first();
        return view('site.terms.index',compact('terms'));
    }

    public function policy()
    {
        $policy = Policy::first();
        return view('site.policy.index',compact('policy'));
    }
}
