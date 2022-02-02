<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth as AdminLogin;

class Auth extends Controller
{
    public function index()
    {
        if (AdminLogin::guard('admin')->user()) {
            return redirect('/admin/dashboard');
        }
        return view('admin.auth.index');
    }

    public function sign_in(Request $request)
    {
        if ($request->remember == 'on') {
            $remember = true;
        } else {
            $remember = false;
        }

        if (AdminLogin::guard('admin')->attempt(['email' => $request->username_email, 'password' => $request->password], $remember) || AdminLogin::guard('admin')->attempt(['username' => $request->username_email, 'password' => $request->password], $remember)) {
            return redirect('/admin/dashboard');
        }

        return redirect('/admin/auth')->with('message', 'Mohon periksa kembali email/username dan password anda!');
    }

    public function sign_out(Request $request)
    {
        AdminLogin::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/auth');
    }

    public function forgot()
    {
        if (AdminLogin::guard('admin')->user()) {
            return redirect('/admin/dashboard');
        }
        return view('admin.auth.forgot');
    }

    public function recover()
    {
        if (AdminLogin::guard('admin')->user()) {
            return redirect('/admin/dashboard');
        }
        return view('admin.auth.recover');
    }
}
