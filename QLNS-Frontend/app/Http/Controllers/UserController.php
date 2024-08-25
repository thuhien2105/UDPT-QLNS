<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification\Notification;

class UserController extends Controller
{
    use Notification;
    public function getFormPage()
    {
        return view('page.auth.form.index');
    }
}
