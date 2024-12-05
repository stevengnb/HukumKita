@extends('layouts.main')

@section('title', 'Home')

@section('custom-styles')

@endsection

@section('content')
    <div>
        <div>
            <img src={{Storage::url($lawyer->profile)}} class="img-fluid rounded-start">

            <div>
                <h3>{{ $lawyer->name }}</h3>
                <p class="card-text">{{ $l->exp_years }} Year(s) of Experience</p>
                {{-- <div class="mx-3 divider-vertical"></div> --}}
                <div>
                    <i class="bi bi-star-fill" style="color: #FEAF27;"></i>
                    {{$lawyer->appointments_avg_rating}}
                </div>

                <div><i class="bi bi-geo-alt"></i>{{ $lawyer->address }}</div>
            </div>
        </div>
    </div>
@endsection
