@extends('layouts.main')

@section('custom-styles')
    <link rel="stylesheet" href="{{asset('css/article.css')}}">
@endsection

@section('title', 'Detail Article')

@section('content')
    <div style="display: flex; flex-direction: column;">

        <div class="d-flex align-items-center mt-5 mb-5 flex-column">
            <h1 class="text-center mb-3" style="width: 60%">{{$article->title}}</h1>
            <div class="py-2 px-3 rounded-pill" style="background-color: rgba(21, 57, 105, 0.15); color: rgba(21, 57, 105, 1); width: fit-content; font-size: 12pt">{{ $article->expertise->name }}</div>
        </div>
        <img class="rounded-5 mb-4" src="data:image/jpeg;base64,{{ base64_encode($article->imagePath) }}" alt="ImageASDAD" style="width:100%; height:40rem; object-fit: cover;" >
        <div class="d-flex flex-row align-items-center">
            <a class="d-flex flex-row align-items-center underline text-black" href="{{ route('getLawyer', ['id'=> $article->lawyer_id]) }}">
                <img class="rounded-circle me-3" style="width: 35px; height: 35px; object-fit: cover" src="data:image/jpeg;base64,{{ base64_encode($article->lawyer->profileLink) }}" alt="">
                <h5 class="mb-0">{{$article->lawyer->name}}</h5>
            </a>

            <i class="bi bi-circle-fill mx-3" style="font-size: 0.25rem;"></i>
            <h6 class="mb-0">{{\Carbon\Carbon::parse($article->createDate)->translatedFormat('l, j F Y')}}</h6>
        </div>

        <p class="mt-5">
            {{$article->description}}
        </p>

        <h5 class="mt-5 mb-3">@lang('texts.articles-page.comment')</h5>
        <div class="mb-4">
            @if (!(Auth::guard('lawyer')->check()))
                <form action="{{ route('comments.store') }}" method="POST" class="form-control d-flex flex-column py-3 px-4 rounded-4">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <div class="d-flex flex-row align-items-center">
                        @if (Auth::check())
                            <img class="rounded-circle" style="width: 40px; height: 40px; object-fit:cover" src="data:image/jpeg;base64,{{ base64_encode(Auth::user()->profileLink) }}" alt="">
                            <h5 class="mb-0 ms-3">{{Auth::user()->username}}</h5>
                        @endif
                    </div>
                    <textarea id="content" name="comment" class="border-0 mt-3 mb-3" style="width: 100%" placeholder="@lang('texts.articles-page.comment-placeholder')"></textarea>
                    <button class="btn btn-dark align-self-end" style="width: fit-content">@lang('texts.articles-page.btn')</i></button>
                </form>
            @endif

            @if ($errors->any())
                <span class="text-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </span>
            @endif
        </div>


        <div class="container-fluid d-flex flex-column gap-4">
            @foreach ($comments as $c)
                <div class="d-flex flex-row" style="width: 100%;">
                    <img class="rounded-circle" style="width: 40px; height: 40px; object-fit:cover" src="data:image/jpeg;base64,{{ base64_encode($c->user->profileLink) }}"alt="">

                    <div class="d-flex flex-column ms-3" style="flex-grow: 1;"> <!-- Allow this to grow -->
                        <div class="d-flex flex-row justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <h5 class="mb-0">{{ $c->user->username }}</h5>
                                <small class="text-secondary ms-2">{{ $c->created_at->diffForHumans(['short' => true]) }}</small>
                            </div>

                            @if ($c->user_id == Auth::id() && !(Auth::guard('lawyer')->check()))
                                <div class="dropdown">
                                    <i class="bi bi-three-dots-vertical" style="cursor: pointer" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <form method="POST" action="{{ route('comments.delete', ['id'=>$c->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item d-flex align-items-center text-danger" type="submit"><i class="bi bi-trash3 me-2"></i>Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <p class="mt-2">{{ $c->comment }}</p>
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
