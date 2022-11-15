<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:edit-profile'],
            'email' => ['required', 'unique:users,email,' . auth()->user()->id, 'email', 'max:60'],
        ]);

        if ($request->imgProfile) {
            $image = $request->file('imgProfile');
            $imageName = Str::uuid() . "." . $image->extension();

            $imageSavedServer = Image::make($image);
            $imageSavedServer->fit(1000, 1000);

            $imagePath = public_path('profiles') . '/' . $imageName;
            $imageSavedServer->save($imagePath);
        }

        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->image = $imageName ?? auth()->user()->image ?? null;
        // Guarda el email si lo cambió (debe pasar la validación(unique)) o de lo contrario mantiene el original (anterior)
        $user->email = $request->email ?? auth()->user()->email;

        // Cambiar la contraseña y guardar si viene en $request
        if ($request->current_password || $request->new_password) {
            $this->validate($request, [
                'current_password' => 'required|min:6',
                'new_password' => 'required|confirmed|min:6'
            ]);

            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
            } else {
                return back()->with('message', 'the old password does not match!');
            }
        }
        // Guardar los cambios hechos incluso si no cambió la contraseña
        $user->save();

        return to_route('post.index', $user->username);
    }
}
