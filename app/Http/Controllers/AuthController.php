<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        // if(session()->has('link')){
        // }else{
        //  session(['link' => url()->previous()]);
        // }
        session()->flash(
            'link',
            session()->has('link') ? session('link') : url()->previous()
        );
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // return redirect()->route('dashboard.index');
            return redirect(session('link'));
        }
        session()->flash('link', session('link'));
        return redirect()->back()->with('error', 'Email or password is incorrect');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|alpha_dash|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        User::create($request->all());
        session()->flash(
            'link',
            route('index')
        );
        return redirect()->route('auth.login')->with('success', 'User created successfully');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('index');
    }
}
