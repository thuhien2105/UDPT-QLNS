<?php

namespace App\Notification;

use Illuminate\Http\Request;

trait Notification
{
    public function addNotification(Request $request, $message, $type = 'success')
    {
        $notifications = $request->session()->get('notifications', []);
        $notifications[] = [
            'message' => $message,
            'type' => $type,
        ];
        $request->session()->put('notifications', $notifications);
    }
    public function clearNotifications(Request $request)
    {
        $request->session()->forget('notifications');
    }
}
