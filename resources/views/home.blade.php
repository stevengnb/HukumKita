<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary px-5">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" style="width: 10%">
            <img src="{{ asset('LawConnect-Horizontal.png') }}" style="width: 100%" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Lawyers/Consultant</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Articles</a>
              </li>
            </ul>

            <div class="dropdown d-flex">
                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img style="width: 50px" src="https://lh5.googleusercontent.com/proxy/t08n2HuxPfw8OpbutGWjekHAgxfPFv-pZZ5_-uTfhEGK8B5Lp-VN4VjrdxKtr8acgJA93S14m9NdELzjafFfy13b68pQ7zzDiAmn4Xg8LvsTw1jogn_7wStYeOx7ojx5h63Gliw" alt="">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="d-grid">
                            <button class="dropdown-item d-flex align-items-center" type="submit"><i class="bi bi-box-arrow-right me-2 d-flex"></i>Logout</button>
                        </div>
                    </form>
                    </li>
                </ul>
            </div>
          </div>
        </div>
      </nav>
    @if (Auth::guard('lawyer')->check())
        <h1>LAWYER YG LOGIN</h1>
    @else
        <h1>USER YG LOGIN</h1>
    @endif
    {{-- <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="d-grid my-3">
            <button class="btn btn-dark btn-lg" type="submit">Logout</button>
        </div>
    </form> --}}
</body>
</html>
