<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification\Notification;

class PageController extends Controller
{
    use Notification;

    public function getHomePage(Request $request)
    {
        return view('page.home');
    }
    public function getLoginPage(Request $request)
    {
        return view('page.auth.login.index');
    }
    public function getSignupPage(Request $request)
    {
        return view('page.auth.register.index');
    }

    public function checkLogin(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::post('https://example.com/api/login', [
            'login' => $validated['login'],
            'password' => $validated['password'],
        ]);

        if ($response->successful()) {
            return redirect()->route('home')->with('status', 'Login successful!');
        } else {
            $this->addNotification($request, 'Login failed! Please check your credentials.', 'error');
            return redirect()->back();
        }
    }

    public function checkSignup(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $response = Http::post('https://example.com/api/signup', [
            'login' => $validated['login'],
            'name' => $validated['name'],
            'password' => $validated['password'],
        ]);

        if ($response->successful()) {
            return redirect()->route('home')->with('status', 'Signup successful!');
        } else {
            $this->addNotification($request, 'Signup failed! Please try again.', 'error');
            return redirect()->back();
        }
    }
}
