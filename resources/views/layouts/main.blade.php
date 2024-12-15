<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('LawConnect-Logo.png') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    @yield('custom-styles')
    @yield('scripts')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary px-5" style="position: fixed; width: 100%; top:0; z-index: 100;">
        <div class="container-fluid position-relative">
            <a class="navbar-brand m-0 position-absolute" href="{{ route('home') }}" style="left: 0; width: 10%">
                <img src="{{ asset('LawConnect-Horizontal.png') }}" style="width: 100%" alt="">
            </a>

            <div class="collapse navbar-collapse d-flex justify-content-center py-2" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">@lang('texts.home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('getLawyers') }}">@lang('texts.lawyers')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/articles">@lang('texts.articles')</a>
                    </li>
                </ul>
            </div>

            <div class="position-absolute d-flex flex-row align-items-center" style="right: 0;">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle me-4" style="text-decoration: none;" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('texts.language')
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item" href="{{ route('changeLang', ['lang'=>'en']) }}">@lang('texts.english')</a></li>
                        <li><a class="dropdown-item" href="{{ route('changeLang', ['lang'=>'id']) }}">@lang('texts.indo')</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="profile-img" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::guard('lawyer')->check())
                            <img src="data:image/jpeg;base64,{{ base64_encode(Auth::guard('lawyer')->user()->profileLink) }}" alt="Profile Image">
                            {{-- <img src="{{ Storage::url(Auth::guard('lawyer')->user()->profile) }}" alt=""> --}}
                        @else
                            <img src="data:image/jpeg;base64,{{ base64_encode(Auth::user()->profileLink) }}" alt="Profile Image">
                            {{-- <img src="{{ Storage::url(Auth::user()->profile) }}" alt=""> --}}
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}"><i class="bi bi-person me-2"></i>@lang('texts.dropdown.profile')</a></li>
                        <li><hr class="dropdown-divider"></li>
                        @if (Auth::guard('lawyer')->check())
                            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('lawyer.appointments') }}"><i class="bi bi-person me-2"></i>@lang('texts.dropdown.my-appointments')</a></li>
                        @else
                            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('user.appointments') }}"><i class="bi bi-person me-2"></i>@lang('texts.dropdown.my-appointments')</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <div class="d-grid">
                                    <button class="dropdown-item d-flex align-items-center" type="submit"><i class="bi bi-box-arrow-right me-2"></i>@lang('texts.dropdown.logout')</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </nav>
    <div style="margin: 8rem 12rem; padding:1px;">
        @yield('content')
    </div>
    <footer class="rounded-top-5">
        <div class="part">
            <div class="part-one-top">
                <div class="part-in-one"><img src="{{ asset('LawConnect-Logo.png') }}" height="35px" alt="LawConnect Logo"></div>
                <p class="part-in-two">@lang('texts.footer.desc')</p>
                <div class="part-in-three">
                    <p>@lang('texts.footer.more')</p>
                    <i class="bi bi-arrow-right d-flex"></i>
                    {{-- <img src="{{ asset('arrow-right.png') }}" height="20px" alt="LawConnect Logo"> --}}
                </div>
            </div>
            <div>&copy; 2024 LawConnect. All rights reserved.</div>
        </div>
        <div class="part">
            <div class="part-two-top">
                <div class="part-component">
                    <p>@lang('texts.footer.features.title')</p>
                    <div class="part-component-body">
                        <p>@lang('texts.footer.features.book')</p>
                        <p>@lang('texts.footer.features.res')</p>
                        <p>@lang('texts.articles')</p>
                    </div>
                </div>
                <div class="part-component">
                    <p>@lang('texts.footer.others.title')</p>
                    <div class="part-component-body">
                        <p>@lang('texts.footer.others.help')</p>
                        <p>@lang('texts.footer.others.contact')</p>
                        <p>@lang('texts.footer.others.feedback')</p>
                    </div>
                </div>
                <div class="part-component">
                    <p>@lang('texts.footer.legal.title')</p>
                    <div class="part-component-body">
                        <p>@lang('texts.footer.legal.privacy')</p>
                        <p>@lang('texts.footer.legal.terms')</p>
                        <p>@lang('texts.footer.legal.refunds')</p>
                    </div>
                </div>
            </div>
            <div>@lang('texts.footer.creds')</div>
        </div>
    </footer>
    {{-- Bootstrap JS Below --}}
</body>
</html>
