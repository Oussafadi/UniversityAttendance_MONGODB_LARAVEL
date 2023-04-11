<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriber;
use App\Mail\Subscribe;
use Illuminate\Support\Facades\Mail;



class SubscriberController extends Controller
{

    public function subscribe(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);


        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $subscriber = new Subscriber();
        $subscriber->email = $request->input('email');
        $subscriber->save();

        if ($subscriber) {
            $email = $request->input('email');
            Mail::to($email)->send(new Subscribe($email));
            return new JsonResponse(['success' => true, 'message' => 'You are now a subscriber ! , please check your inbox'], 200);
        }
    }
}
