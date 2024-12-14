@extends('layouts.main')

@section('title', 'Book Appointment')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endsection

@section('content')
    <div class="appointment-container">
        <div class="hero-section">
            <h1>@lang('texts.booking-page.title')</h1>
            <p>@lang('texts.booking-page.desc')<span>{{ $lawyer->name }}</span>, @lang('texts.booking-page.desc_2'){{ implode(', ', $lawyer->expertise_names) }}.
            </p>
        </div>

        <div class="main-content">
            <div class="lawyer-profile border border-secondary-subtle rounded-5">
                <img src="data:image/jpeg;base64,{{ base64_encode($lawyer->profileLink) }}" class="img-fluid rounded-circle">
                <h2>{{ $lawyer->name }}</h2>
                <p><i class="bi bi-geo-alt"></i> {{ $lawyer->address }}</p>
                <p><strong>@lang('texts.exp'):</strong> {{ $lawyer->exp_years }} @lang('texts.years')</p>
                <p><strong>@lang('texts.rate'):</strong> @dollar($lawyer->rate)</p>
            </div>

            <div class="booking-form border border-secondary-subtle rounded-5">
                <h4 class="mb-4">@lang('texts.booking-page.form.title')</h4>
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lawyer_id" value="{{ $lawyer->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- <div class="mb-3">
                        <label for="dateTime" class="form-label">Select Date & Time</label>
                        <input type="datetime-local" id="dateTime" name="dateTime" class="form-control" required>
                    </div> -->

                    <div class="mb-3">
                        <label for="dateTime" class="form-label">@lang('texts.booking-page.form.label')</label>
                        <input type="datetime-local" id="dateTime" name="dateTime"
                            class="form-control @error('dateTime') is-invalid @enderror" required>
                        @error('dateTime')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark btn-md">@lang('texts.booking-page.form.btn')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
