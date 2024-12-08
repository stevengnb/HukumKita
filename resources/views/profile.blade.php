@extends('layouts.main')

@section('title', 'Edit Profile')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
@section('custom-styles')

@endsection

@section('content')
    <h1 class="mb-3">My Profile</h1>
    <div class="d-flex flex-row align-items-center card p-5 rounded-5">
        @if (Auth::guard('lawyer')->check())
            <img class="profile" src="{{Storage::url(Auth::guard('lawyer')->user()->profile)}}" alt="">
        @else
            <img class="profile" src="{{Storage::url(Auth::user()->profile)}}" alt="">
        @endif
        <div class="ms-5">
            <h2>{{ Auth::user()->name }}</h2>
            @if (Auth::guard('lawyer')->check())
                <h6 class="text-secondary">Lawyer</h6>
            @else
                <h6 class="text-secondary">User</h6>
            @endif
        </div>
    </div>

    <div class="card rounded-5 p-5 mt-5">
        <h3>Personal Information</h3>

        <div class="container mt-4">
            <div class="row p-0">
                <div class="col-md-6 p-0">
                    <div class="mb-3">
                        <h6 class="text-secondary">Name</h6>
                        <h6>{{ Auth::user()->name }}</h6>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-secondary">Email</h6>
                        <h6>{{ Auth::user()->email }}</h6>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-secondary">Phone Number</h6>
                        <h6>{{ Auth::user()->phoneNumber }}</h6>
                    </div>
                </div>

                <div class="col-md-6 p-0">
                    <div class="mb-3">
                        <h6 class="text-secondary">Role</h6>
                        @if (Auth::guard('lawyer')->check())
                            <h6>Lawyer</h6>
                        @else
                            <h6>User</h6>
                        @endif
                    </div>

                    <div class="mb-3">
                        <h6 class="text-secondary">Date of Birth</h6>
                        <h6>{{ Auth::user()->dob }}</h6>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-secondary">Gender</h6>
                        <h6>{{ Auth::user()->gender }}</h6>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
