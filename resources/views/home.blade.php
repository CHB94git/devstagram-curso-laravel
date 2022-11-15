@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <x-list-post :posts="$posts" />
@endsection
