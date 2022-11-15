<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return to_route('home', [
                'posts' => auth()->user()->posts
            ]);
        }

        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        // dd($request->get('name'));

        // Interceptar y modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validaciones
        $this->validate($request, [
            'name' => ['required', 'max:30'],
            'username' => 'required|unique:users|min:3|max:20',
            'email' => ['required', 'unique:users', 'email', 'max:60'],
            'password' => 'required|min:6|confirmed'
        ]);

        // dd('Creando usuario...');

        User::create([
            'name' => $request->name,
            // 'username' => Str::slug($request->username),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Autenticar usuario registrado
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);
        Auth::attempt($request->only('email', 'password'));
        // auth()->attempt($request->only('email', 'password'));

        // return redirect()->route('post.index');
        return to_route('post.index', auth()->user()->username);
    }
}
