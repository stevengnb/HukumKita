@extends('layouts.main')

@section('title', 'User Appointments')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/user-appointments.css') }}">
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">@lang('texts.app-table.title')</h1>

        @if ($appointments->isEmpty())
            <div class="alert alert-info text-center">
                @lang('texts.app-table.no-app')
            </div>
        @else
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">@lang('texts.profile-page.lawyer')</th>
                        <th scope="col">@lang('texts.address')</th>
                        <th scope="col">@lang('texts.datetime')</th>
                        <th scope="col">Status</th>
                        <th scope="col">@lang('texts.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $index => $appointment)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $appointment->lawyer->name }}</td>
                            <td>{{ $appointment->lawyer->address }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->dateTime)->format('F j, Y g:i A') }}</td>

                            <td>
                                <span class="badge bg-{{ $appointment->status === 'Completed' ? 'success' : 'warning' }} fw-normal px-3 rounded-pill py-2">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                @if ($appointment->status === 'Pending' || $appointment->status === 'Confirmed')
                                    <a href="{{ route('getLawyer', ['id' => $appointment->lawyer->id]) }}"
                                        class="btn btn-primary btn-sm">
                                        @lang('texts.app-table.detail')
                                    </a>
                                @elseif ($appointment->status === 'Completed')
                                    <a href="{{ route('getLawyer', ['id' => $appointment->lawyer->id]) }}"
                                        class="btn btn-success btn-sm">
                                        @lang('texts.app-table.rating')
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
