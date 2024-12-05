@extends('layouts.main')

@section('title', 'Lawyers')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/lawyer.css') }}">
@endsection

@section('content')
<div class="containerLawyer">

    <form class="search-form d-flex position-sticky sticky-top" role="search" method="GET" action="{{ route('getLawyers') }}">
        <input class="form-control me-2" type="search" name="search" placeholder="Search Lawyer's Name" aria-label="Search" value="{{ request('search') }}">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    <div class="lawyer-list-container">
        <div class="d-flex flex-row flex-fill gap-5">
            <form class="filter-form border border-1 rounded-3 p-4 position-sticky sticky-top" action="{{ route('getLawyers') }}" method="GET">
                <div class="mb-3">
                    <label for="price_range" class="mb-2">Price Range</label>
                    <select class="form-select" name="price_range" id="price_range">
                        <option value="">All Price Range</option>
                        <option value="1-3" {{ request('price_range') == '1-3' ? 'selected' : '' }}>1 - 3</option>
                        <option value="4-5" {{ request('price_range') == '4-5' ? 'selected' : '' }}>4 - 5</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="expertise" class="mb-2">Expertise</label>
                    <select class="form-select" name="expertise" id="expertise">
                        <option value="">All Expertise</option>
                        @foreach ($expertises as $e)
                            <option value="{{ $e->id }}" {{ request('expertise') == $e->id ? 'selected' : '' }}>{{ $e->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-dark" type="submit">Filter</button>
            </form>

            <div class="lawyers-list flex-fill">
                @foreach ($lawyers as $l)
                    <div>
                        <a class="card mb-3" href="">
                            <div class="row g-0">
                            <div class="col-md-4">
                                <img src={{Storage::url($l->profile)}} class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                <h5 class="card-title">{{ $l->name }}</h5>
                                <div class="d-flex flex-row align-items-center">
                                    <p class="card-text">{{ $l->exp_years }} Year(s) of Experience</p>
                                    <div class="mx-3 divider-vertical"></div>
                                    <div>
                                        <i class="bi bi-star-fill" style="color: #FEAF27;"></i>
                                        {{$l->appointments_avg_rating}}
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                @foreach ($l->expertise_names as $e)
                                        <div class="p-2 rounded-3 expertise text-light fs-6">{{ $e }}</div>
                                @endforeach
                                </div>
                                <h5 class="card-title">@dollar($l->rate)</h5>
                                {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> --}}
                                </div>
                            </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {!! $lawyers->appends(request()->query())->links('pagination::bootstrap-4') !!}
        </div>

    </div>

</div>


@endsection
