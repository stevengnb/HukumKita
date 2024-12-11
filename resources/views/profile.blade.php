@extends('layouts.main')

@section('title', 'Edit Profile')
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
@section('custom-styles')

@endsection

@section('content')
    <h1 class="mb-3">My Profile</h1>
    <div class="d-flex flex-row align-items-center justify-content-between card p-5 rounded-5">
        <div class="d-flex flex-row align-items-center">
            @if (Auth::guard('lawyer')->check())
                <img class="profile" src="{{Storage::url(Auth::guard('lawyer')->user()->profile)}}" alt="">
            @else
                <img class="profile" src="{{Storage::url(Auth::user()->profile)}}" alt="">
            @endif
            <div class="ms-5">
                @if (Auth::guard('lawyer')->check())
                    <h2>{{ Auth::guard('lawyer')->user()->name }}</h2>
                @else
                    <h2>{{ Auth::user()->name }}</h2>
                @endif
                @if (Auth::guard('lawyer')->check())
                    <h6 class="text-secondary">Lawyer</h6>
                @else
                    <h6 class="text-secondary">User</h6>
                @endif
            </div>
        </div>

        <div class="d-flex flex-column gap-3">
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#changePasswordModal"><i class="bi bi-key me-2"></i>Change Password</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal"><i class="bi bi-trash3 me-2"></i>Delete Account</button>
        </div>

        <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-5 p-4">
                    <div class="modal-header" style="border: none;">
                        <h5 class="modal-title" id="deleteAccountModalLabel">Confirm Account Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete your account? This action cannot be undone.
                    </div>
                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ Auth::guard('lawyer')->check() ? route('lawyer.deleteAccount') : route('user.deleteAccount') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-5 p-4">
                    <div class="modal-header" style="border: none;">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ Auth::guard('lawyer')->check() ? route('lawyer.changePassword') : route('changePassword') }}"  method="POST" class="d-flex gap-3 flex-column">
                        <div class="modal-body d-flex flex-column gap-3">
                                @csrf
                                <div class="d-flex flex-column">
                                    <label for="currentPassword">Current Password</label>
                                    <input class="form-control @error('current_password') is-invalid @enderror" type="password" name="current_password" id="current_password" required>
                                    @error('current_password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="d-flex flex-column">
                                    <label for="newPassword">New Password</label>
                                    <input class="form-control" type="password" name="new_password" id="new_password" required>
                                </div>

                                <div class="d-flex flex-column">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input class="form-control" type="password" name="new_password_confirmation" id="new_password_confirmation" required>
                                </div>
                        </div>

                        <div class="modal-footer" style="border: none;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-5 p-4">
                    <div class="modal-header" style="border: none;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                        <i class="bi bi-check-lg text-success mb-3" style="font-size: 64pt"></i>
                        Your password has been changed successfully!
                    </div>
                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded-5 p-5 mt-5">
        <h3>Personal Information</h3>

        <div class="container mt-4">
            <div class="row p-0">
                <div class="col-md-6 p-0">
                    <div class="mb-3">
                        <h6 class="text-secondary">Name</h6>
                        @if (Auth::guard('lawyer')->check())
                            <h6>{{ Auth::guard('lawyer')->user()->name }}</h6>
                        @else
                            <h6>{{ Auth::user()->name }}</h6>
                        @endif
                    </div>

                    <div class="mb-3">
                        <h6 class="text-secondary">Email</h6>
                        @if (Auth::guard('lawyer')->check())
                            <h6>{{ Auth::guard('lawyer')->user()->email }}</h6>
                        @else
                            <h6>{{ Auth::user()->email }}</h6>
                        @endif
                    </div>

                    <div class="mb-3">
                        <h6 class="text-secondary">Phone Number</h6>
                        @if (Auth::guard('lawyer')->check())
                            <h6>{{ Auth::guard('lawyer')->user()->phoneNumber }}</h6>
                        @else
                            <h6>{{ Auth::user()->phoneNumber }}</h6>
                        @endif
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
                        @if (Auth::guard('lawyer')->check())
                            <h6>{{ Auth::guard('lawyer')->user()->dob }}</h6>
                        @else
                            <h6>{{ Auth::user()->dob }}</h6>
                        @endif
                    </div>

                    <div class="mb-3">
                        <h6 class="text-secondary">Gender</h6>
                        @if (Auth::guard('lawyer')->check())
                            <h6>{{ Auth::guard('lawyer')->user()->gender }}</h6>
                        @else
                            <h6>{{ Auth::user()->gender }}</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if (Auth::guard('lawyer')->check())
    <div class="card rounded-5 p-5 mt-5">
        <h3>Lawyer Information</h3>
        <h6 class="text-secondary mt-4">Expertise</h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach (Auth::guard('lawyer')->user()->expertises as $expertise)
                <h6 class="py-2 px-3 rounded-pill m-0" style="width: fit-content; background-color: rgba(21, 57, 105, 0.15); color: rgba(21, 57, 105, 1);">{{ $expertise->name }}</h6>
            @endforeach
        </div>

        <h6 class="text-secondary mt-3">Rate</h6>
        <h6>@dollar(Auth::guard('lawyer')->user()->rate)</h6>

        <h6 class="text-secondary mt-3">Education</h6>
        <h6>{{Auth::guard('lawyer')->user()->education}}</h6>
    </div>
    @endif
@endsection

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
            myModal.show();
        });
    </script>
@endif

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
@endif
