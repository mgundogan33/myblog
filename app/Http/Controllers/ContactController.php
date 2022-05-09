<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\Test;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }
    public function store()
    {
        Contact::create(
            request()->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'subject' => 'nullable|min:5|max:50',
                'message' => 'nullable|min:5|max:500',
            ])
        );

        Mail::to("gundogan.mehmet33@gmail.com")->send(new Test("Mehmet"));

        return redirect()->route('contact.create')->with('success','Mesajın Gönderildi');
    }
}
