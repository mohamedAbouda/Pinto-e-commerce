<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactRequest;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\About;
use App\Models\Policy;
use App\Models\Term;
use App\PolicyFAQ;
use App\TermFAQ;

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
        return view('site.contact-us')->with(['contact' => $contact]);
    }

    public function submit(ContactRequest $request)
    {
        $data = $request->all();
        $save = ContactMessage::create($data);
        alert()->success('Message Sent', '');
        return redirect()->back();
    }

    public function about()
    {
        $about = About::first();
        return view('site.about',compact('about'));
    }

    public function terms()
    {
        $data['terms'] = Term::first();
        $data['terms_faq'] = TermFAQ::all();

        return view('site.terms' ,$data);
    }

    public function policy()
    {
        $data['policy'] = Policy::first();
        $data['policy_faq'] = PolicyFAQ::all();

        return view('site.policy' ,$data);
    }
}
