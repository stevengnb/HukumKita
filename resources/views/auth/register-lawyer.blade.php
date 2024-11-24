<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registers</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
                <h2>Seeking Justice Together</h2>
                <p>Provide legal consultation services from anywhere and anytime according to your field of expertise</p>
            </div>

            <div class="in">
                <h2 class="mb-3 text-center">Register as Lawyer</h2>

                <div class="progress-container d-flex flex-row flex-fill justify-content-around position-relative">
                    <div class="step d-flex flex-column align-items-center" id="step-progress-1">
                        <span class="circle active mb-2">1</span>
                        <p>Account Details</p>
                    </div>
                    <div class="line d-flex flex-fill position-absolute"></div>
                    <div class="step d-flex flex-column align-items-center" id="step-progress-2">
                        <span class="circle mb-2">2</span>
                        <p class="text-center">Additional Information</p>
                    </div>
                </div>

                <form class="form" method="POST" action="{{ route('lawyer.register.process') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="step-1">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <div class="input-password">
                                <input name="password" type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" placeholder="">
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                            </div>
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
                                    <input type="radio" class="btn-check" name="gender" id="male" value="male" autocomplete="off">
                                    <label class="btn btn-outline-secondary flex-fill" style="border-top-right-radius: 0; border-bottom-right-radius: 0" for="male">Male</label>

                                    <input type="radio" class="btn-check" name="gender" id="female" value="female" autocomplete="off">
                                    <label class="btn btn-outline-secondary flex-fill" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: 0" for="female">Female</label>
                                </div>
                            </div>
                            <div class="flex-fill">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input name="dob" type="date" class="form-control" id="dob" placeholder="">
                            </div>
                        </div>
                        <div class="d-flex align-items-end" style="width: 100%">
                            <button type="button" id="nextToStep2" class="btn btn-outline-dark d-flex align-items-center justify-content-center ms-auto">
                                Next <i class="bi bi-arrow-right-circle ms-2 d-flex"></i>
                            </button>
                        </div>
                    </div>

                    <div id="step-2" style="display: none;">
                        <div class="mb-3 d-flex flex-column">
                            <label for="profile">Upload Profile Picture</label>
                            <img id="image_preview" class="rounded-circle mx-auto" src="https://lh5.googleusercontent.com/proxy/t08n2HuxPfw8OpbutGWjekHAgxfPFv-pZZ5_-uTfhEGK8B5Lp-VN4VjrdxKtr8acgJA93S14m9NdELzjafFfy13b68pQ7zzDiAmn4Xg8LvsTw1jogn_7wStYeOx7ojx5h63Gliw" alt="Preview Image" style="width: 200px; height: 200px; object-fit: cover; margin-top: 10px;">
                            <input required type="file" class="form-control-file" style="display: none;" id="profile" name="profile" accept="image/*" onchange="previewImage(event)">
                        </div>
                        <div class="mb-3">
                            <label for="education" class="form-label">Education</label>
                            <input name="education" type="text" class="form-control" id="education" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="">
                        </div>
                        <div class="mb-3 d-flex flex-row gap-3">
                            <div class="flex-fill">
                                <label for="experience" class="form-label">Experience Start Date</label>
                                <input name="experience" type="date" class="form-control" id="experience" placeholder="">
                            </div>
                            <div class="flex-fill">
                                <label for="rate" class="form-label">Rate</label>
                                <input name="rate" type="number" class="form-control" id="rate" placeholder="">
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="button" id="backToStep1" class="btn btn-outline-dark d-flex align-items-center justify-content-center mb-3" style="width: fit-content">
                                <i class="bi bi-arrow-left-circle me-2 d-flex"></i> Back
                            </button>
                            <button class="btn btn-dark btn-lg" type="submit">{{ __('Register') }}</button>
                        </div>
                    </div>

                    {{-- <div class="d-grid mt-5">
                        <button class="btn btn-dark btn-lg" type="submit">{{ __('Register') }}</button>
                        <p class="mt-3 text-center">Already have a LawConnect account? <a href="{{ route('lawyer.login') }}">Login</a></p>
                    </div> --}}

                    <p class="mt-3 text-center">Already have a LawConnect Lawyer account? <a href="{{ route('lawyer.login') }}">Login</a></p>

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
    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const line = document.querySelector('.line');
    const nextToStep2 = document.getElementById('nextToStep2');
    const backToStep1 = document.getElementById('backToStep1');
    const stepProgress1 = document.getElementById('step-progress-1');
    const stepProgress2 = document.getElementById('step-progress-2');

    nextToStep2.addEventListener('click', () => {
        step1.style.display = 'none';
        step2.style.display = 'block';

        // stepProgress1.querySelector('.circle').classList.add('active');
        stepProgress2.querySelector('.circle').classList.add('active');
        line.classList.add('line-active');
    });

    backToStep1.addEventListener('click', () => {
        step2.style.display = 'none';
        step1.style.display = 'block';

        stepProgress2.querySelector('.circle').classList.remove('active');
        // stepProgress1.querySelector('.circle').classList.add('active');
        line.classList.remove('line-active');
    });

    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle('bi-eye');
    });

    function previewImage(event) {
        const imagePreview = document.getElementById('image_preview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
    }

    const imgPreview = document.getElementById('image_preview');
    imgPreview.addEventListener('click', () => {
        document.getElementById('profile').click();
    });
</script>
</html>
