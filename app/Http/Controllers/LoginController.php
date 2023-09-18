<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function showLoginForm(){
        return view('superadmin.login');
    }

    public function ceklogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            if ($user->role === 'superadmin') {
                $request->session()->regenerate();
                return redirect('/dashboard');
            } elseif ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect('/dashboardadmin');
            }
        } else {
            return back()->withInput()->with('error', 'Email atau password salah. Silakan coba lagi.');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Ubah rute ini sesuai dengan rute yang Anda inginkan setelah log out
    }
}
