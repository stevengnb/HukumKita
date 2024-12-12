<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/component.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    {{-- ini pake bootstrap icons mau pake cdn ato engga? ini gw pake cdn dlu --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
</head>

<body>
    <div class="wrapper" style="background-color: rgba(21, 57, 105, 0.05)">
        <img class="bg-img" src="{{ asset('banner-register-lawyer.png') }}" alt="">
        <div class="container">
            <div class="logo">
                <img src="{{ asset('LawConnect-Lawyer.png') }}" alt="LawConnect Logo">
                <h2>@lang('texts.login.heading')</h2>
                <p>@lang('texts.login.body')</p>
            </div>
            <div class="in">
                <h2 class="mb-5">@lang('texts.login.btn-lawyer-login')</h2>
                <form class="form" method="POST" action="{{ route('lawyer.login.process') }}">
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="email" class="form-label">@lang('texts.login.input-email')</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="">
                        </div>
                        <div class="input-password-container">
                            <label for="password" class="form-label">@lang('texts.login.input-password')</label>
                            <div class="input-password">
                                <input name="password" type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" placeholder="">
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mt-5">
                        <button class="btn btn-dark btn-lg" type="submit">{{ __('Login') }}</button>
                        <p class="mt-3 text-center">@lang('texts.login.reg-lawyer') <a href="{{ route('lawyer.register') }}">Register</a></p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle('bi-eye');
    });
</script>
</html>
