@extends('layouts.app')

@section('title')
    Login in Devstagram
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img class="rounded-lg" src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuario">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-xl shadow-2xl">
            <form action={{ route('login') }} method="POST" novalidate>
                @csrf

                @if (session()->has('message'))
                    <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                        <p class="bg-red-500 text-white my-2 rounded-lg text-md p-3 text-center">
                            {{ session()->get('message') }}
                        </p>
                    </div>
                @endif

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
                        id="password" name="password" placeholder="Enter your password" type="password" />

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="text-gray-500 text-sm">
                        <input type="checkbox" name="remember" class="ml-2" />
                        Mantener mi sesión abierta
                    </label>
                </div>

                <input type="submit" value="Login"
                    class="bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-xl" />
            </form>
        </div>
    </div>
@endsection
