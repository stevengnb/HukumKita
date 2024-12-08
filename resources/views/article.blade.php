@extends('layouts.main')

@section('title', 'Law Articles')

@section('content')
    <div style="width: max;">
        <div style="display: flex; flex-direction: row; margin-bottom: 2rem; gap:1rem; height:3rem;">
            <input class="form-control mr-sm-2" style="" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" style="" type="submit">Search</button>
        </div>

        {{-- Grid of 4 --}}
        <h1>Popular Article</h1>
        <section class="" style="margin:2rem 0; padding:0; width: 100%;">
            <div class="row" style="row-gap: 2rem;">
                @foreach ($articles as $article)
                    <div class="col-3">
                        <a class="card h-100 rounded-4 overflow-hidden" style="text-align: justify; text-decoration: none; color: black;" href="/articles/{{$article->id}}">
                            <img class="card-img-top" src={{$article->imagePath}} alt="Image" style="width:100%; height:14rem;" >

                            <div class="card-body">
                                <div class="py-2 px-3 rounded-pill" style="background-color: rgba(21, 57, 105, 0.15); color: rgba(21, 57, 105, 1); width: fit-content; font-size: 10pt">{{ $article->expertise->name }}</div>
                                <h5 class="mt-3 text-start">{{$article->title}}</h5>
                                <span class="text-secondary" style="font-size: 11pt">{{Str::limit($article->description, 100)}}</span>
                            </div>

                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    {{ $articles->links('pagination::bootstrap-5') }}
@endsection
