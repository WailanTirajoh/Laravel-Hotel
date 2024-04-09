<?php

namespace App\Http\Controllers;

class NotificationsController extends Controller
{
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function routeTo($id)
    {
        $notification = auth()->user()->Notifications->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return redirect($notification->data['url']);
    }
}
