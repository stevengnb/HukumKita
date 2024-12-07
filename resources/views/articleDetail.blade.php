@extends('layouts.main')

@section('custom-styles')
    <link rel="stylesheet" href="{{asset('css/article.css')}}">
@endsection

@section('title', 'Detail Article')

@section('content')
    <div style="display: flex; flex-direction: column;">
        <img class="rounded-5" src={{asset($article->imagePath)}} alt="Image" style="width:100%; height:48rem;" >
        <h1 class="mt-5 mb-3">{{$article->title}}</h1>
        <div class="d-flex flex-row align-items-center">
            <a class="d-flex flex-row align-items-center underline text-black" href="{{ route('getLawyer', ['id'=> $article->lawyer_id]) }}">
                <img class="rounded-circle me-3" style="width: 35px; height: 35px; object-fit: cover" src="{{Storage::url($article->lawyer->profile)}}" alt="">
                <h5 class="mb-0">{{$article->lawyer->name}}</h5>
            </a>

            <i class="bi bi-circle-fill mx-3" style="font-size: 0.25rem;"></i>
            <h6 class="mb-0">{{\Carbon\Carbon::parse($article->createDate)->translatedFormat('l, j F Y')}}</h6>
        </div>

        <p class="mt-5">
            {{$article->description}}
        </p>

        <h5 class="mt-5 mb-3">Comment(s)</h5>

        <form action="{{ route('comments.store') }}" method="POST" class="form-control py-3 px-4">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <div class="d-flex flex-row align-items-center">
                @if (Auth::check())
                    <img class="rounded-circle" style="width: 40px; height: 40px; object-fit:cover" src="{{Storage::url(Auth::user()->profile)}}" alt="">
                    <h5 class="mb-0 ms-3">{{Auth::user()->username}}</h5>
                @endif
            </div>
            <textarea id="content" name="comment" class="border-0 mt-3" style="width: 100%" placeholder="Add a comment..."></textarea>
            <button class="btn btn-dark">Comment</i></button>
        </form>

        @if ($errors->any())
            <span class="text-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </span>
        @endif

        <div class="mt-4">
            @foreach ($article->comments as $c)
                <div class="d-flex flex-row">
                    <img class="rounded-circle" style="width: 40px; height: 40px; object-fit:cover" src="{{Storage::url($c->user->profile)}}" alt="">

                    <div class="d-flex flex-column ms-3">
                        <div class="d-flex flex-row align-items-center">
                            <h5 class="mb-0">{{$c->user->username}}</h5>
                            <small class="text-secondary ms-2">{{ $c->created_at->diffForHumans() }}</small>
                        </div>

                        <p class="mt-2">{{$c->comment}}</p>
                    </div>
                </div>
                @endforeach
        </div>

    </div>

    <script>
        const textarea = document.getElementById('content');

        textarea.addEventListener('input', () => {
            textarea.style.height = 'auto';
            textarea.style.height = `${textarea.scrollHeight}px`;
        });
    </script>
@endsection
