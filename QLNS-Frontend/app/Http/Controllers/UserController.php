<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getFormPage()
    {
    	return view('page.user.form.index');
    }
}
