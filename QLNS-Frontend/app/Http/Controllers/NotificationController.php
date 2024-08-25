<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function clearNotifications(Request $request)
    {
        $request->session()->forget('notifications');
        return response()->json(['success' => true]);
    }
}
