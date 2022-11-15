@extends('layouts.app')

@section('title')
    Sign up for devstagram
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img class="rounded-md" src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-xl shadow-2xl">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Name
                    </label>
                    <input
                        class="border p-3 w-full rounded-xl shadow @error('name')
                        border-red-500
                    @enderror"
                        id="name" name="name" value="{{ old('name') }}" placeholder="Your name" type="text" />

                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input
                        class="border p-3 w-full rounded-xl shadow @error('username')
                        border-red-500
                    @enderror"
                        id="username" name="username" placeholder="Example: user123" type="text"
                        value="{{ old('username') }}" />

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        class="border p-3 w-full rounded-xl shadow @error('email')
                        border-red-500
                    @enderror"
                        id="email" name="email" placeholder="Enter your email" type="email"
                        value="{{ old('email') }}" />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                        class="border p-3 w-full rounded-xl shadow @error('password')
                        border-red-500
                    @enderror"
                        id="password" name="password" placeholder="Type a password" type="password" />

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repeat password
                    </label>
                    <input class="border p-3 w-full rounded-xl shadow" id="password_confirmation"
                        name="password_confirmation" placeholder="Enter password again" type="password" />

                </div>

                <input type="submit" value="Create Account"
                    class="bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-xl" />
            </form>
        </div>
    </div>
@endsection
