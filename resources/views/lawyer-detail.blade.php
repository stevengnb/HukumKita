@extends('layouts.main')

@section('title', 'Lawyer Details')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/lawyer-detail.css') }}">
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div class="d-flex flex-row gap-5 mb-5">
            <img class="lawyer-img rounded-3" src={{ Storage::url($lawyer->profile) }}>

            <div class="d-flex flex-column gap-2">
                <h1>{{ $lawyer->name }}</h1>
                <h5 class="card-text"><i class="bi bi-calendar me-2"></i>{{ $lawyer->exp_years }} Year(s) of Experience</h5>
                {{-- <div class="mx-3 divider-vertical"></div> --}}
                <div>
                    <i class="bi bi-star-fill" style="color: #FEAF27;"></i>
                    {{ $lawyer->appointments_avg_rating }} <span class="text-secondary" style="font-size: 9pt">/5</span>
                    <span class="text-secondary fs-6 ms-2">{{ $lawyer->appointments_total_ratings }} Rating(s)</span>
                </div>

                <div><i class="bi bi-geo-alt me-1"></i>{{ $lawyer->address }}</div>
            </div>
        </div>

        <div class="d-flex flex-column" style="width: 15%">
            <h3 class="align-self-end mb-1">@dollar($lawyer->rate)</h3>

            @php
                $userHasBooked = $lawyer->appointments
                    ->where('user_id', auth()->user()->id)
                    ->where('status', 'Pending')
                    ->isNotEmpty();
            @endphp

            @if ($userHasBooked)
                <button class="btn btn-dark" disabled>Pending</button>
            @else
                <a class="card mb-3" href="{{ route('getLawyerBooking', ['id' => $lawyer->id]) }}">
                    <button class="btn btn-dark">Consult</button>
                </a>
            @endif
        </div>
    </div>

    <div>
        <h5 class="fw-bold">Expertise</h5>
        <div class="d-flex flex-wrap gap-2 mt-2">
            @foreach ($lawyer->expertise_names as $e)
                <div class="p-2 rounded-3 expertise fw-semibold">{{ $e }}</div>
            @endforeach
        </div>

        <h5 class="mt-3 fw-bold">Education</h5>
        <h6>{{ $lawyer->education }}</h6>

        <h5 class="mt-3 fw-bold">Reviews <span class="text-secondary ms-1 fw-normal"
                style="font-size: 12pt">{{ $lawyer->appointments_total_ratings }} Rating(s)</span></h5>
        <div class="reviews">
            @if ($lawyer->appointments_total_ratings > 0)
                @foreach ($lawyer->appointments as $a)
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                <i class="bi bi-star-fill me-1" style="color: #FEAF27;"></i>
                                {{ $a->rating }}<span class="text-secondary" style="font-size: 10pt">/5</span>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-2">
                                <img class="rounded-circle me-2" src="{{ Storage::url($a->user->profile) }}"
                                    alt="">
                                <h5 class="mb-0">{{ $a->user->name }}</h5>
                            </div>

                            <p class="card-text">{{ $a->review }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <h6>No Reviews</h6>
            @endif
        </div>
    </div>
@endsection
