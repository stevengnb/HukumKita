@extends('layouts.main')

@section('title', 'Home')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/lawyer-detail.css') }}">
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div class="d-flex flex-row gap-5 mb-5">
            <img class="lawyer-img rounded-3" src={{Storage::url($lawyer->profile)}}>

            <div class="d-flex flex-column gap-2">
                <h1>{{ $lawyer->name }}</h1>
                <h5 class="card-text"><i class="bi bi-calendar me-2"></i>{{ $lawyer->exp_years }} Year(s) of Experience</h5>
                {{-- <div class="mx-3 divider-vertical"></div> --}}
                <div>
                    <i class="bi bi-star-fill" style="color: #FEAF27;"></i>
                    {{$lawyer->appointments_avg_rating}} <span class="text-secondary" style="font-size: 9pt">/5</span>
                    <span class="text-secondary fs-6 ms-2">{{ $lawyer->appointments_total_ratings }} Rating(s)</span>
                </div>

                <div><i class="bi bi-geo-alt me-1"></i>{{ $lawyer->address }}</div>
            </div>
        </div>

        <div>
            <h3 class="mb-0">@dollar($lawyer->rate)</h3>
            <button class="btn btn-dark">Consult</button>
        </div>
    </div>

    <div>
        <h5>Expertise</h5>
        <div class="d-flex flex-wrap gap-2 mt-2">
            @foreach ($lawyer->expertise_names as $e)
                <div class="p-2 rounded-3 expertise fw-semibold">{{ $e }}</div>
            @endforeach
        </div>

        <h5><i class="bi bi-mortarboard"></i> Education</h5>
        <h6>{{$lawyer->education}}</h6>

        <h5 class="mt-3"><i class="bi bi-star"></i> Reviews <span class="text-secondary">{{ $lawyer->appointments_total_ratings }} Ratings</span></h5>

    </div>
@endsection
