<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'image' => ['required']
        ]);
        // Formas de guardar en la BD (1)
        // Post::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'user_id' => auth()->user()->id
        // ]);

        // Formas de guardar en la BD (2)
        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->image = $request->image;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // Formas de guardar en la BD (3) - Usando la relación creada en el Modelo(user->posts())
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => trim($request->description),
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        return to_route('post.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar la imagen asociada al post
        $img_path = public_path('uploads' . '/' . $post->image);

        if (File::exists($img_path)) {
            unlink($img_path);
        }

        return to_route('post.index', auth()->user()->username);
    }
}
