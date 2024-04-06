<?php

namespace App\Http\Controllers\Admin\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function adminLogin(){
        return view('admin.pages.login.admin_login');
    }
    public function adminLoginRequest(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 1) {
                return redirect()->route('AdminDashboard');
            } else {
                return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['error' => 'Invalid credentials']);
        }
    }
}
