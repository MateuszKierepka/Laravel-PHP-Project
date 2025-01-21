<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HelpController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        Mail::send([], [], function ($message) use ($request) {
            $message->to('bujajgondole@gmail.com')
                    ->subject('Zgłoszenie pomocy: ' . $request->subject)
                    ->from($request->email)
                    ->html($request->message);

            if ($request->hasFile('attachment')) {
                $message->attach($request->file('attachment')->getRealPath(), [
                    'as' => $request->file('attachment')->getClientOriginalName(),
                    'mime' => $request->file('attachment')->getMimeType(),
                ]);
            }
        });

        Mail::send([], [], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Potwierdzenie zgłoszenia pomocy')
                    ->from('bujajgondole@gmail.com')
                    ->html('Dziękujemy za kontakt. Otrzymaliśmy Twoje zgłoszenie i wkrótce się z Tobą skontaktujemy.');
        });

        return back()->with('success', 'Twoje zgłoszenie pomocy zostało pomyślnie wysłane.');
    }
}
