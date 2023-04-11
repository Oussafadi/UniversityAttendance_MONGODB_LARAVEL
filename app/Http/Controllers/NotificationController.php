<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        //dd(Auth::user()->UnreadNotifications);
        $notifications = Auth::user()->UnreadNotifications;
        //dd($notifications);

        return view('student.notifications', compact('notifications'));
    }

    public function ReadNotification($id)
    {
        $UserUnreadNotif = auth()->user()
            ->unreadNotifications
            ->where('id', $id)
            ->first();
        if ($UserUnreadNotif) {
            $UserUnreadNotif->markAsRead();
        }

        return redirect()->back();
    }
}
