<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KhachHangLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:khachhang',['except'=>['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.customer-login');
    }

    public function login(Request $request)
    {
        //validate fornm data
        $this->validate($request,
            [
                'email' =>  'required|email',
                'password'  =>  'required|min:6'
            ]);

        //attempt to log the admin
        if (Auth::guard('khachhang')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember))
        {
            //if successful, then redirect to their intended location
            return redirect()->intended('khachhang.dashboard');
        }

        //if unsuccessful, then redirect back to login with the form data
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout()
    {
        Auth::guard('khachhang')->logout();
        return redirect('/index');
    }
}
