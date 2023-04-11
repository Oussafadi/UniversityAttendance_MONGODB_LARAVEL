<?php

namespace App\Http\Controllers;

use App\Mail\GoogleMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailGoogleController extends Controller
{
    public function googleMail()
    {
        return view('emails.emailForm');
    }

    public function sendGoogleMail(Request $request)
    {
        $this->validate($request, [
            'messages' => 'required',
            'subject' => 'required'
        ]);

        // $users=User::all(); email all users

        $ana = User::where('name', '=', 'fadil')->get();
        //dd($ana);
        //Mail::mailer()
        Mail::to($ana)
            ->send(new GoogleMail($request->input('subject'), $request->input('messages')));

        return back()->with('message', 'Email succesfully sent !');
    }
}
