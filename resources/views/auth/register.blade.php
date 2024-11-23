<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registers</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
    {{-- ini pake bootstrap items mau pake cdn ato engga? ini gw pake cdn dlu --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
</head>
<body>
    <div class="wrapper">
        <img class="bg-img" src="{{ asset('banner-register.png') }}" alt="">
        <div class="container">
            <div class="logo">
                <img src="{{ asset('LawConnect.png') }}" alt="LawConnect Logo">
                <h2>Seeking Justice Together</h2>
                <p>Consult your legal issues, anytime and anywhere</p>
            </div>

            <div class="in">
                <h2>Register to LawConnect</h2>
                <form class="form" method="POST" action="{{ route('register.process') }}">
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input name="username" type="text" class="form-control" id="username" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input name="phoneNumber" type="text" class="form-control" id="phoneNumber" placeholder="">
                        </div>
                        <div class="mb-3 d-flex flex-row gap-3">
                            <div class="flex-fill">
                                <label for="gender" class="form-label">Gender</label>
                                {{-- <input name="gender" type="text" class="form-control" id="gender" placeholder="Your gender.."> --}}
                                <div class="d-flex">
                                    <input type="radio" class="btn-check" name="gender" id="male" value="male" autocomplete="off" required>
                                    <label class="btn btn-outline-primary flex-fill" style="border-top-right-radius: 0; border-bottom-right-radius: 0" for="male">Male</label>

                                    <input type="radio" class="btn-check" name="gender" id="female" value="female" autocomplete="off" required>
                                    <label class="btn btn-outline-primary flex-fill" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: 0" for="female">Female</label>
                                </div>
                            </div>
                            <div class="flex-fill">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input name="dob" type="date" class="form-control" id="dob" placeholder="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="">
                        </div>
                        <div>
                            <label for="inputPassword5" class="form-label">Password</label>
                            <div class="input-password">
                                <input name="password" type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" placeholder="">
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mt-5">
                        <button class="btn btn-dark btn-lg" type="submit">{{ __('Register') }}</button>
                        <p class="mt-3 text-center">Already have a LawConnect account? <a href="{{ route('login') }}">Login</a></p>
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
