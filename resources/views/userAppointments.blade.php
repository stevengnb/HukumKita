@extends('layouts.main')

@section('title', 'User Appointments')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/user-appointments.css') }}">
@endsection

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">My Appointments</h1>

        @if ($appointments->isEmpty())
            <div class="alert alert-info text-center">
                You have no appointments yet.
            </div>
        @else
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Lawyer</th>
                        <th scope="col">Address</th>
                        <th scope="col">Date & Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
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
                                <span class="badge bg-{{ $appointment->status === 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                @if ($appointment->status === 'Pending' || $appointment->status === 'Confirmed')
                                    <a href="{{ route('getLawyer', ['id' => $appointment->lawyer->id]) }}"
                                        class="btn btn-primary btn-sm">
                                        View Detail
                                    </a>
                                @elseif ($appointment->status === 'Completed')
                                    <a href="{{ route('getLawyer', ['id' => $appointment->lawyer->id]) }}"
                                        class="btn btn-success btn-sm">
                                        Give Rating
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
