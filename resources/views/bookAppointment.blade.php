@extends('layouts.main')

@section('title', 'Book Appointment')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endsection

@section('content')
    <div class="appointment-container">
        <div class="hero-section">
            <h1>Book Your Appointment</h1>
            <p>Consult with <span>{{ $lawyer->name }}</span>, an expert in {{ implode(', ', $lawyer->expertise_names) }}.
            </p>
        </div>

        <div class="main-content">
            <div class="lawyer-profile border border-secondary-subtle rounded-5">
                <img src="{{ Storage::url($lawyer->profile) }}" alt="Lawyer Profile Picture">
                <h2>{{ $lawyer->name }}</h2>
                <p><i class="bi bi-geo-alt"></i> {{ $lawyer->address }}</p>
                <p><strong>Experience:</strong> {{ $lawyer->exp_years }} years</p>
                <p><strong>Rate:</strong> @dollar($lawyer->rate)</p>
            </div>

            <div class="booking-form border border-secondary-subtle rounded-5">
                <h4 class="mb-4">Schedule Your Appointment</h4>
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lawyer_id" value="{{ $lawyer->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- <div class="mb-3">
                        <label for="dateTime" class="form-label">Select Date & Time</label>
                        <input type="datetime-local" id="dateTime" name="dateTime" class="form-control" required>
                    </div> -->

                    <div class="mb-3">
                        <label for="dateTime" class="form-label">Select Date & Time</label>
                        <input type="datetime-local" id="dateTime" name="dateTime"
                            class="form-control @error('dateTime') is-invalid @enderror" required>
                        @error('dateTime')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark btn-md">Book Appointment</button>
                </form>
            </div>
        </div>
    </div>
@endsection
