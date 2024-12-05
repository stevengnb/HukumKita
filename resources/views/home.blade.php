@extends('layouts.main')

@section('title', 'Home')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="containerHome">
        <h1>Simplify Your Legal Journey</h1>
        <p>LawConnect empowers you to book consultations with trusted lawyers, learn your rights, and navigate legal challenges</p>
        <button class="btn-12"><span>Get Started</span></button>
        {{-- @if (Auth::guard('lawyer')->check())
        <h1>LAWYER YG LOGIN</h1>
        @else
        <h1>USER YG LOGIN</h1>
        @endif --}}
    </div>
    <div class="consultation">
        <h3>What Legal Consultation Do You Need?</h3>
        <div class="cat">
            @foreach ($categories as $category)
                <div class="card">
                    <p class="title">{{ $category->name }}</p>
                    <p class="description">{{ $category->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="article">
        <h3>Latest Article</h3>
        <div class="cat">
            @foreach ($articles as $article)
                <div class="card">
                    <img style="border-radius: 5px;" src="{{ asset($article['image']) }}" alt="LawConnect Article">
                    <div style="background-color: #44638B; color:white; padding: 5px; border-radius: 5px;">{{ $article['categories'] }}</div>
                    <p style="font-weight: 700; font-size: 18px; padding: 0;">{{ $article['title'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="article">
        <h3>Trusted Advice for Every Legal Concern!</h3>
        <div class="cat">
            @foreach ($testimonials as $testimonial)
            <div class="card-testimonial" style="position: relative; border: 0.5px solid rgba(0, 0, 0, 0.2);">
                <p style="font-size: 16px; padding: 0;">{{ $testimonial['body'] }}</p>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <img style="border-radius: 5px;" src="{{ asset('profile.svg') }}" alt="Profile Svg">
                    <p style="font-weight: 700; font-size: 18px; padding: 0;">{{ $testimonial['name'] }}</p>
                </div>
                <img style="border-radius: 5px; position: absolute; bottom: 20px; right: 20px;" src="{{ asset('testimony.svg') }}" width="25px" alt="Testimonial Svg">
            </div>
            @endforeach
        </div>
    </div>
    @endsection
