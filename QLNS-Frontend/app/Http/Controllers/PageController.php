<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $response = Http::post('http://127.0.0.1:8000/api/signin', [
            'username' => $validated['username'],
            'password' => $validated['password'],
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            $employee = $responseData['response']['employee']['employee'];
            $token = $responseData['response']['employee']['token'];
            $name = $responseData['response']['employee']['name'];
            $role = $employee['role'] ?? '';
            $request->session()->put('token', $token);
            $request->session()->put('role', $role);
            return response()->json(
                [
                    'response' => [
                        'status' => 'Login successful',
                        'employee' => [
                            'employee' => $responseData['response']['employee']['employee'],
                            'token' => $responseData['response']['employee']['token'],
                        ],
                    ],
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Login failed! Please check your credentials.',
                ],
                401,
            );
        }
    }

    public function checkLogout(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/signout', [
            'token' => $request->session()->get('token'),
        ]);

        if ($response->successful()) {
            $request->session()->forget('token');
            return response()->json(
                [
                    'response' => [
                        'status' => 'Logout successful',
                    ],
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Login failed! Please check your credentials.',
                ],
                401,
            );
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
