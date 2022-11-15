<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return to_route('home', [
                'posts' => auth()->user()->posts
            ]);
        }
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);


        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('message', 'Incorrect Credentials!!');
        }

        // return redirect()->route('post.index', auth()->user()->username);
        return to_route('post.index', auth()->user()->username);
    }


    public function destroy()
    {
        Auth::logout();
        // auth()->logout();

        // return redirect()->route('login');
        return to_route('login');
    }
}
