<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Μπορείς να στείλεις email ή να το αποθηκεύσεις
        Mail::raw($request->message, function ($mail) use ($request) {
            $mail->to('armenisnick@gmail.com')
                ->subject('New Contact from '.$request->name)
                ->replyTo($request->email);
        });

        return back()->with('success', 'Thank you for contacting us. We will get back to you soon!');
    }
}
