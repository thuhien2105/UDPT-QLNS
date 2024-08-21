<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getHomePage()
    {
    	return view('page.home');
    }
    public function getLoginPage()
    {
    	return view('page.auth.login.index');
    }
    public function getSignupPage()
    {
    	return view('page.auth.register.index');
    }

}
