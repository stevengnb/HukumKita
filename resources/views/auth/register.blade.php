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
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="in">
                <h2>Registers</h2>
                <form class="formm" method="POST" action="{{ route('register.process') }}">
                    @csrf
                    <div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Your name..">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input name="username" type="text" class="form-control" id="username" placeholder="Your username..">
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input name="phoneNumber" type="text" class="form-control" id="phoneNumber" placeholder="Your phoneNumber..">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <input name="gender" type="text" class="form-control" id="gender" placeholder="Your gender..">
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input name="dob" type="date" class="form-control" id="dob" placeholder="Your dob..">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="Your email..">
                        </div>
                        <div>
                            <label for="inputPassword5" class="form-label">Password</label>
                            <input name="password" type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Your password..">
                        </div>
                    </div>
                    <div class="d-grid my-3">
                        <button class="btn btn-dark btn-lg" type="submit">{{ __('Register') }}</button>
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
