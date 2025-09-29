<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showlogin (){
        return view('login');
    }

    // Logika untuk login
    public function processLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|email',
            'password' => 'required',
        ]);

        // Coba autentikasi user
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke dashboard
            return redirect()->route('dashboard-industri');
        }

        // Jika login gagal
        return back()->withErrors([
            'error' => 'Email atau password salah!',
        ])->withInput();
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/siriba/login');
    }
}
