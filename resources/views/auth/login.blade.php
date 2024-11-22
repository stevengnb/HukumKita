<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="in">
                <h2>Login</h2>
                <form class="formm" method="POST" action="{{ route('login.process') }}">
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="Your email..">
                        </div>
                        <div>
                            <label for="inputPassword5" class="form-label">Password</label>
                            <input name="password" type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Your password..">
                        </div>
                    </div>
                    <div class="d-grid my-3">
                        <button class="btn btn-dark btn-lg" type="submit">{{ __('Login') }}</button>
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
</html>
