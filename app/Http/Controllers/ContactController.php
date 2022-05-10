<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }
    public function store()
    {
        $data = array();
        $data['name'] = 'Mehmet';
        return response()->json($data);

        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'subject' => 'nullable|min:5|max:50',
            'message' => 'nullable|min:5|max:500',
        ]);

        Contact::create($attributes);

        Mail::to("gundogan.mehmet33@gmail.com")->send(new ContactMail(
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['email'],
            $attributes['subject'],
            $attributes['message']
        ));

        return redirect()->route('contact.create')->with('success', 'Mesajın Gönderildi');
    }
}
