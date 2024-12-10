@extends('layouts.main')

@section('title', 'Law Articles')

@section('content')
    <div style="width: 100%;">
        <div class="position-sticky sticky-top px-0 z-3" style="top: 60px; display: flex; flex-direction: row; margin-bottom: 2rem; background-color: white; padding: 40px 0 20px 0;">
            <form method="GET" action="{{ route('showArticles') }}" role="search" class="d-flex" style="width: 100%;">
                <input
                    class="form-control me-2 rounded-pill py-2 px-3"
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search"
                    aria-label="Search">
                <button
                    class="btn btn-dark rounded-pill"
                    type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            @if(Auth::guard('lawyer')->check())
                <button
                    class="btn btn-dark rounded-pill ms-2 d-flex flex-row align-items-center"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="bi bi-pencil-square d-flex me-1"></i>
                    <span>Create</span>
                </button>
            @endif
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Headline</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter the article headline" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter the article description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="expertise_id" class="form-label">Category</label>
                            <select class="form-select" id="expertise_id" name="expertise_id" required>
                                <option value="" selected disabled>Select a category</option>
                                <option value="1">Marriage & Divorce</option>
                                <option value="2">Civil Law</option>
                                <option value="3">Employment Law</option>
                                <option value="4">Land and Property Law</option>
                                <option value="5">Tax Law</option>
                                <option value="6">Criminal Law</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Banner Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ms-auto">Post</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

        {{-- Grid of 4 --}}
        <h1>Popular Article</h1>
        <section class="" style="margin:2rem 0; padding:0; width: 100%;">
            <div class="row" style="row-gap: 2rem;">
                @foreach ($articles as $article)
                    <div class="col-3">
                        <a class="card h-100 rounded-4 overflow-hidden" style="text-align: justify; text-decoration: none; color: black;" href="/articles/{{$article->id}}">
                            <img class="card-img-top" src={{Storage::url($article->imagePath)}} alt="Image" style="width:100%; height:14rem;" >

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
    {{ $articles->appends(request()->query())->links('pagination::bootstrap-5') }}
@endsection
