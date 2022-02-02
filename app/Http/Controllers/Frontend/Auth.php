<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth as MemberLogin;

class Auth extends Controller
{
    public function index()
    {
        if (MemberLogin::guard('user')->user()) {
            return redirect('/member');
        }
        return view('frontend.auth.index');
    }

    public function sign_in(Request $request)
    {
        if (MemberLogin::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/member');
        }

        return redirect('/auth');
    }

    public function sign_out()
    {
        MemberLogin::guard('user')->logout();
        return redirect('/auth');
    }
}
