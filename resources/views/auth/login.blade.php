<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - LawConnect</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/component.css') }}"> --}}
    {{-- ini pake bootstrap icons mau pake cdn ato engga? ini gw pake cdn dlu --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
</head>

<body>
    <div class="wrapper">
        <img class="bg-img" src="{{ asset('banner-register.png') }}" alt="">
        <div class="container">
            <div class="logo">
                <img src="{{ asset('LawConnect.png') }}" alt="LawConnect Logo">
                <h2>Seeking Justice Together</h2>
                <p>Consult your legal issues, anytime and anywhere with LawConnect</p>
            </div>
            <div class="in">
                <h2 class="mb-3">Login to LawConnect</h2>
                <form class="form" method="POST" action="{{ route('login.process') }}">
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="">
                        </div>
                        <div class="input-password-container">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-password">
                                <input name="password" type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" placeholder="">
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mt-5">
                        <button class="btn btn-dark btn-lg" type="submit">{{ __('Login') }}</button>
                        <p class="mt-3 mb-0 text-center">Don't have a LawConnect account yet? <a href="{{ route('register') }}">Register</a></p>

                        <div class="divider"></div>
                        <p class="mb-2">Are you a LawConnect Lawyer?</p>
                        <a class="btn btn-outline-dark d-flex align-items-center justify-content-center" href="{{ route('lawyer.login') }}">
                            Login as a Lawyer <i class="bi bi-arrow-right-circle ms-2 d-flex"></i>
                        </a>
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
