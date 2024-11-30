@extends('layouts.main')

@section('title', 'Law Articles')

@section('content')
    <div style="display: flex; flex-direction: row; margin-bottom: 2rem; gap:1rem; height:3rem;">
        <input class="form-control mr-sm-2" style="" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" style="" type="submit">Search</button>
    </div>

    {{-- Grid of 4 --}}
    <h1>Popular Article</h1>
    <section class="container" style="margin:2rem 0; padding:0;">
        <div class="row g-4">
            @foreach ($articles as $article)
                <div class="col">
                    <div style="background:">
                        <img src={{$article->imagePath}} alt="Image" style="width:12rem; height:8rem;" >
    
                        <h3 class="underline">{{$article->title}}</h3>
                        <span style="">{{Str::limit($article->description, 100)}}</span>
                    </div>
                </div>
            @endforeach 
        </div>
    </section>
    {{ $articles->links('pagination::bootstrap-5') }}
@endsection