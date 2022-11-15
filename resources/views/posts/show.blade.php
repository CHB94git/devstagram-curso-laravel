@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Post image {{ $post->title }}" class="rounded">

            <div class="p-3 flex items-center gap-2">
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
            </div>

            <div>
                <a href="{{ route('post.index', $post->user->username) }}" class="font-bold text-lg">
                    {{ $post->user->username }}
                </a>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit"
                            class="bg-red-500 hover:bg-red-700 p-2 rounded text-white font-bold mt-3 cursor-pointer"
                            value="Delete Post" />
                    </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5 rounded-lg">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Add a new comment
                    </p>
                    @if (session()->has('message'))
                        <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)"
                            class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form action="{{ route('comments.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5 mt-5">
                            <label for="commentary" class="mb-2 block uppercase text-gray-500 font-bold">
                                Comment
                            </label>
                            <textarea id="commentary" name="commentary" placeholder="Add a comment"
                                class="border p-3 w-full rounded-xl shadow @error('commentary')
                            border-red-500
                        @enderror">
                    </textarea>

                            @error('commentary')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <input type="submit" value="Post comment"
                            class="bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-xl" />
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('post.index', $comment->user) }}" class="font-bold">
                                    {{ $comment->user->username }}
                                </a>
                                <p>{{ $comment->commentary }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">There are no comments yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
