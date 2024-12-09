@extends('layouts.main')

@section('title', 'Lawyers')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/lawyer.css') }}">
@endsection

@section('content')
    <div class="containerLawyer">
        <h1>Browse Lawyers that Suit Your Needs</h1>
        <div class="search-wrapper position-sticky sticky-top px-0 z-3">
            <form class="search-form d-flex" role="search" method="GET" action="{{ route('getLawyers') }}">
                <input class="form-control me-2 rounded-pill py-2 px-3" type="search" name="search"
                    placeholder="Search Lawyer's Name" aria-label="Search" value="{{ request('search') }}">
                <button class="btn btn-outline-success rounded-pill" type="submit">Search</button>
            </form>
        </div>

        <div class="lawyer-list-container">
            <div class="d-flex flex-row flex-fill gap-3">
                <form
                    class="filter-form shadow-sm border border-1 rounded-4 p-4 position-sticky sticky-top z-2 d-flex flex-column"
                    action="{{ route('getLawyers') }}" method="GET">
                    <div class="mb-3">
                        <label for="price_range" class="mb-2">Price Range</label>
                        <select class="form-select" name="price_range" id="price_range">
                            <option value="">All Price Range</option>
                            <option value="1-3" {{ request('price_range') == '1-3' ? 'selected' : '' }}>1 - 3</option>
                            <option value="4-5" {{ request('price_range') == '4-5' ? 'selected' : '' }}>4 - 5</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="expertise" class="mb-2">Expertise</label>
                        <select class="form-select" name="expertise" id="expertise">
                            <option value="">All Expertise</option>
                            @foreach ($expertises as $e)
                                <option value="{{ $e->id }}" {{ request('expertise') == $e->id ? 'selected' : '' }}>
                                    {{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-dark ms-auto" type="submit"><i class="bi bi-funnel me-1"></i> Filter</button>
                </form>

                <div class="lawyers-list">
                    @foreach ($lawyers as $l)
                        <a class="card shadow-sm mb-3 rounded-4 overflow-hidden"
                            href="{{ route('getLawyer', ['id' => $l->id]) }}">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src={{ Storage::url($l->profile) }} class="img-fluid rounded-start">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body d-flex flex-column" style="height: 100%;">
                                        <div class="d-flex flex-column flex-grow-1">
                                            <h5 class="card-title h4 fw-semibold">{{ $l->name }}</h5>
                                            <div class="d-flex flex-row align-items-center">
                                                <p class="card-text">{{ $l->exp_years }} Year(s) of Experience</p>
                                                <div class="mx-3 divider-vertical"></div>
                                                <div>
                                                    <i class="bi bi-star-fill" style="color: #FEAF27;"></i>
                                                    {{ $l->appointments_avg_rating }}
                                                    <span
                                                        class="text-secondary fs-6 ms-2">{{ $l->appointments_total_ratings }}
                                                        Rating(s)</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2 mt-2">
                                                @foreach ($l->expertise_names as $e)
                                                    <div class="py-2 px-3 rounded-pill expertise fw-semibold">
                                                        {{ $e }}</div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Button Section (Rate & Consult) -->
                                        <div class="d-flex flex-row align-items-center justify-content-between mt-auto">
                                            <h5 class="mb-0 fw-semibold">@dollar($l->rate)</h5>

                                            <!-- Cek appointment status dan display button bsd status -->
                                            @if (auth()->check())
                                                @if ($l->user_appointment_status === 'Pending')
                                                    <button class="btn btn-warning">Pending</button>
                                                @elseif ($l->user_appointment_status === 'Confirmed')
                                                    <button class="btn btn-success">Confirmed</button>
                                                @elseif ($l->user_appointment_status === 'Completed')
                                                    <button class="btn btn-dark">Already Consulted</button>
                                                @else
                                                    <button class="btn btn-dark">Consult</button>
                                                @endif
                                            @else
                                                <button class="btn btn-secondary" disabled>Not Authorized</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {!! $lawyers->appends(request()->query())->links('pagination::bootstrap-4') !!}
            </div>

        </div>

    </div>


@endsection
