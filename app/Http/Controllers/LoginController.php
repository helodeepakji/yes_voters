<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required',
        ]);

        $credentialsField = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where($credentialsField, $request->email_or_phone)->first();

        if (!$user) {
            return back()->withErrors([$credentialsField => ucfirst($credentialsField) . ' not found'])->withInput();
        }

        if (!Auth::attempt([$credentialsField => $request->email_or_phone, 'password' => $request->password])) {
            return back()->withErrors(['password' => 'Incorrect password'])->withInput();
        }

        return redirect()->route('index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
    
}