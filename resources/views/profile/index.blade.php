@extends('layouts.app')

@section('title')
    Edit Profile: {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6 rounded-lg">
            @if (session()->has('message'))
                <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)"
                    class="bg-yellow-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-8">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input
                        class="border p-3 w-full rounded-xl shadow @error('username')
                        border-red-500
                    @enderror"
                        id="username" name="username" value="{{ auth()->user()->username }}" placeholder="Your username"
                        type="text" />

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imgProfile" class="mb-2 block uppercase text-gray-500 font-bold">
                        Profile picture
                    </label>
                    <input class="border p-3 w-full rounded-xl shadow" id="imgProfile" name="imgProfile" value=""
                        type="file" accept=".jpeg, .jpg, .png" />

                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input
                        class="border p-3 w-full rounded-xl shadow @error('email')
                        border-red-500
                    @enderror"
                        id="email" name="email" placeholder="Enter your new email (if apply)" type="email"
                        value="{{ auth()->user()->email }}" />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="current_password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input
                        class="border p-3 w-full rounded-xl shadow @error('current_password')
                        border-red-500
                    @enderror"
                        id="current_password" name="current_password" placeholder="Type your current password"
                        type="password" />

                    @error('current_password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">
                        New Password
                    </label>
                    <input
                        class="border p-3 w-full rounded-xl shadow @error('new_password')
                        border-red-500
                    @enderror"
                        id="new_password" name="new_password" placeholder="Type a new password" type="password" />

                    @error('new_password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="new_password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repeat password
                    </label>
                    <input class="border p-3 w-full rounded-xl shadow" id="new_password_confirmation"
                        name="new_password_confirmation" placeholder="Enter your new password again" type="password" />

                </div>

                <input type="submit" value="Update profile"
                    class="bg-indigo-500 hover:bg-indigo-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-xl" />
            </form>
        </div>
    </div>
@endsection
