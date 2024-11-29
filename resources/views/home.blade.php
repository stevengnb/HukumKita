@extends('layouts.main')

@section('title', 'Home')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="containerHome">
        @if (Auth::guard('lawyer')->check())
        <h1>LAWYER YG LOGIN</h1>
        @else
        <h1>USER YG LOGIN</h1>
        @endif
    </div>
@endsection
