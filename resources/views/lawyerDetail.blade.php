@extends('layouts.main')

@section('title', 'Lawyer Details')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/lawyer-detail.css') }}">
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-stretch mb-5">
        <div class="d-flex align-items-stretch">
            <img
                class="lawyer-img rounded-5"
                src="{{ Storage::url($lawyer->profile) }}"
                style="object-fit: cover; width: 200px; height: 100%;">
        </div>

        <div class="card d-flex flex-row flex-grow-1 ms-4 rounded-5 p-5">
            <div class="d-flex flex-column gap-2" style="flex: 1;">
                <h1>{{ $lawyer->name }}</h1>
                <h5 class="card-text"><i class="bi bi-calendar me-2"></i>{{ $lawyer->exp_years }} @lang('texts.lawyers-page.lawyer-card.exp')</h5>
                <div>
                    <i class="bi bi-star-fill" style="color: #FEAF27;"></i>
                    {{ $lawyer->appointments_avg_rating }} <span class="text-secondary" style="font-size: 9pt">/5</span>
                    <span class="text-secondary fs-6 ms-2">{{ $lawyer->appointments_total_ratings }} @lang('texts.lawyers-page.lawyer-card.rating')</span>
                </div>
                <div><i class="bi bi-geo-alt me-1"></i>{{ $lawyer->address }}</div>
            </div>

            <div class="d-flex flex-column">
                <h3 class="align-self-end mb-1">@dollar($lawyer->rate)</h3>
                @if (auth()->check())
                    @if ($lawyer->user_appointment_status === 'Pending')
                        <button class="btn btn-warning" style="color: #6B450E;">@lang('texts.lawyers-page.lawyer-card.btn-pending')</button>
                    @elseif ($lawyer->user_appointment_status === 'Confirmed')
                        <button class="btn btn-success">@lang('texts.lawyers-page.lawyer-card.btn-confirmed')</button>
                    @elseif ($lawyer->user_appointment_status === 'Completed')
                        <button class="btn btn-dark">@lang('texts.lawyers-page.lawyer-card.btn-done')</button>
                    @else
                        <a class="card mb-3" href="{{ route('getLawyerBooking', ['id' => $lawyer->id]) }}">
                            <button class="btn btn-dark">@lang('texts.lawyers-page.lawyer-card.btn')</button>
                        </a>
                    @endif
                @else
                    <button class="btn btn-secondary" disabled>@lang('texts.lawyers-page.lawyer-card.btn-notauth')</button>
                @endif
            </div>
        </div>
    </div>



    <div>
        <h5 class="fw-bold">@lang('texts.lawyers-page.filter.expertise')</h5>
        <div class="d-flex flex-wrap gap-2 mt-2">
            @foreach ($lawyer->expertise_names as $e)
                <div class="py-2 px-3 rounded-pill expertise fw-semibold">{{ $e }}</div>
            @endforeach
        </div>

        <h5 class="mt-5 fw-bold">@lang('texts.lawyers-page.education')</h5>
        <h6>{{ $lawyer->education }}</h6>

        {{-- Rating & Review Form HERE --}}
        @if (auth()->check() && $lawyer->user_appointment_status === 'Completed')
            <h5 class="mt-5 fw-bold">@lang('texts.lawyers-page.rating')</h5>
            <form action="{{ route('updateRatingReview', ['userId' => auth()->id(), 'lawyerId' => $lawyer->id]) }}"
                method="POST" class="mt-2">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label fw-bold">@lang('texts.lawyers-page.lawyer-card.rating')</label>
                    <select id="rating" name="rating" class="form-select" required>
                        <option value="" disabled selected>@lang('texts.lawyers-page.select-rating')</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="review" class="form-label fw-bold">@lang('texts.lawyers-page.review')</label>
                    <textarea class="form-control @error('review') is-invalid @enderror" id="review" name="review" rows="3"
                        required>{{ old('review', $appointment->review ?? '') }}</textarea>
                    @error('review')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark">@lang('texts.submit')</button>
            </form>
        @endif

        <h5 class="mt-5 fw-bold">@lang('texts.lawyers-page.review') <span class="text-secondary ms-1 fw-normal"
                style="font-size: 12pt">{{ $lawyer->appointments_total_ratings }} @lang('texts.lawyers-page.lawyer-card.rating')</span></h5>
        <div class="reviews">
            @if ($lawyer->appointments_total_ratings > 0)
                @foreach ($completedAppointments as $a)
                    <div class="card mb-2">
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
                <h6>@lang('texts.lawyers-page.no-review')</h6>
            @endif
        </div>
    </div>
@endsection
