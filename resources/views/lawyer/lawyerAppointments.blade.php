@extends('layouts.main')

@section('title', 'Lawyer Appointments')

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
                        <th scope="col">@lang('texts.profile-page.user')</th>
                        <th scope="col">Email</th>
                        <th scope="col">@lang('texts.profile-page.personal-info.phone-number')</th>
                        <th scope="col">@lang('texts.profile-page.personal-info.gender')</th>
                        <th scope="col">DOB</th>
                        <th scope="col">@lang('texts.profile-page.lawyer')</th>
                        <th scope="col">@lang('texts.datetime')</th>
                        <th scope="col">Status</th>
                        <th scope="col">@lang('texts.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $index => $appointment)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $appointment->user->name }}</td>
                            <td>{{ $appointment->user->email }}</td>
                            <td>{{ $appointment->user->phoneNumber }}</td>
                            <td>{{ $appointment->user->gender }}</td>
                            <td>{{ $appointment->user->dob }}</td>
                            <td>{{ $appointment->lawyer->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->dateTime)->format('F j, Y g:i A') }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $appointment->status === 'Completed' ? 'success' : ($appointment->status === 'Pending' ? 'warning' : 'primary') }} fw-normal px-3 rounded-pill py-2">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                @if ($appointment->status === 'Pending')
                                    <form
                                        action="{{ route('updateAppointmentStatus', ['userId' => $appointment->user->id, 'lawyerId' => $appointment->lawyer->id, 'newStatus' => 'Confirmed']) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">@lang('texts.app-table.confirm-btn')</button>
                                    </form>
                                @elseif ($appointment->status === 'Confirmed')
                                    <form
                                        action="{{ route('updateAppointmentStatus', ['userId' => $appointment->user->id, 'lawyerId' => $appointment->lawyer->id, 'newStatus' => 'Completed']) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">@lang('texts.app-table.complete-btn')</button>
                                    </form>
                                @elseif ($appointment->status === 'Completed')
                                    <button class="btn btn-secondary" disabled>@lang('texts.app-table.completed')</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
