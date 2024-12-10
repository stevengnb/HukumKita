@extends('layouts.main')

@section('title', 'Home')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="containerHome">
        <h1 class="text-white">Simplify Your Legal Journey</h1>
        <p class="text-white">LawConnect empowers you to book consultations with trusted lawyers, learn your rights, and navigate legal challenges</p>
        <button class="btn-12"><span>Get Started</span></button>
        {{-- @if (Auth::guard('lawyer')->check())
        <h1>LAWYER YG LOGIN</h1>
        @else
        <h1>USER YG LOGIN</h1>
        @endif --}}
        <img src="{{ asset('assets/home-bg.png') }}" alt="">
    </div>
    <div class="consultation position-relative rounded-5 overflow-hidden">
        <h3 class="text-white">What Legal Consultation Do You Need?</h3>
        <div class="cat z-1">
            @foreach ($categories as $category)
                <div class="card category-card p-4 rounded-4">
                    <div class="d-flex flex-row align-items-center">
                        <img style="width: 30px; height: 30px" src="{{ asset('assets/' . $category->name . '-icon.png') }}" alt="">
                        <p class="ms-2 title">{{ $category->name }}</p>
                    </div>
                    <p class="description fs-6 mt-2">{{ $category->description }}</p>
                </div>
            @endforeach
        </div>
        <img class="position-absolute bottom-0 end-0" style="width: 100%" src="{{ asset('assets/shape-wave-home.webp') }}" alt="">
    </div>
    <div class="article">
        <h3>Latest Articles</h3>
        <div class="cat">
            @foreach ($articles as $article)
                <a class="card rounded-5 overflow-hidden position-relative article-card" href="/articles/{{$article->id}}">
                    <img class="card-img-top" src="{{ asset('art.jpg') }}" alt="LawConnect Article">
                    <div class="position-absolute" style="bottom: 0; width: 100%; height: 70%; background-image: linear-gradient(to top, rgba(21, 57, 105, 1), rgba(0, 0, 0, 0));"></div>

                    <div class="card-body p-4 position-absolute d-flex flex-column justify-content-between" style="height: 100%; width: 100%">
                        <div class="py-2 px-3 rounded-pill" style="background-color: white; color: rgba(21, 57, 105, 1); width: fit-content; font-size: 11pt">{{ $article->expertise->name }}</div>
                        <div class="d-flex flex-row justify-content-between align-items-end w-100">
                            <p class="h5 mb-0 text-white">{{ $article->title }}</p>
                            <i class="bi bi-arrow-right-circle-fill align-items-center justify-content-center d-flex" style="color: white; font-size: 2rem"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="article">
        <h3>Trusted Advice for Every Legal Concern!</h3>
        <div class="cat">
            @foreach ($testimonials as $testimonial)
            <div class="card-testimonial rounded-4" style="position: relative; border: 0.5px solid rgba(0, 0, 0, 0.2);">
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
