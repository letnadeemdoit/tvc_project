{{--    topnav    --}}
<div class="topnav py-1 bg-topnav  d-none d-md-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-center justify-content-md-start">

                    <a href="#"> <i class="fa-brands fa-facebook-f fs-3 text-white pt-1"></i></a>
                    <a href="#"> <i class="bi-twitter mx-3 fs-3 text-white"></i></a>
                    <a href="#"> <i class="bi-instagram fs-3 text-white"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div
                    class="d-block d-md-flex float-end align-items-center w-100 justify-content-center justify-content-md-end">
                    <div
                        class="d-flex align-items-center justify-content-center justify-content-md-start py-1 py-md-0 pe-3">
                        <i class="fas fa-phone me-2 text-white"></i>
                        <a href="tel:0000-000-0" class="mb-0 text-white fs-12">000-000-000</a>
                    </div>
                    <div
                        class="d-flex align-items-center ms-md-2 ms-4 justify-content-center justify-content-md-start">
                        {{--                        <img src="{{asset('/images/images-home/Email.svg')}}" class="img-fluid me-2">--}}
                        <i class="fa-regular fa-envelope text-white me-2 fs-3"></i>
                        <a class="mb-0 text-white fs-12" href="mailto:someone@example.com">trips.calendar@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--   topnnav     --}}

<header id="header" class="navbar navbar-expand-lg navbar-bordered bg-white  ">
    <div class="container">
        <!--   nav     -->
        <nav class="js-mega-menu navbar-nav-wrap d-flex justify-content-center py-2">
            <a class="navbar-brand" href="{{route('guest.welcome')}}">
                <img class="navbar-brand-logo"
                     src="<?php echo e(asset('logo/logo.svg')); ?>"
                     alt="Logo" data-hs-theme-appearance="default"/>
            </a>

            <button class="navbar-toggler fs-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="#navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-default">
                    <i class="bi-list"></i>
                </span>
                <span class="navbar-toggler-toggled">
                 <i class="bi-x"></i>
                 </span>
            </button>

            <div class="collapse navbar-collapse align-items-center" id="navbarTogglerDemo02">
                <ul class="navbar-nav  mb-2 mb-lg-0 mx-auto d-flex justify-content-center guset-menu">
                    <li class="nav-item my-1 my-lg-0">
                        <a class="nav-link {{ request()->routeIs('guest.welcome') ? 'active' : '' }}"
                           aria-current="page" href="{{route('guest.welcome')}}">HOME</a>
                    </li>
                    <li class="nav-item my-1 my-lg-0">
                        <a class="nav-link {{ request()->routeIs('guest.privacy-policy') ? 'active' : '' }}"
                           href="{{route('guest.privacy-policy')}}">POLICIES</a>
                    </li>
                    <li class="nav-item my-1 my-lg-0">
                        <a class="nav-link {{ request()->routeIs('guest.contact') ? 'active' : '' }}"
                           href="{{route('guest.contact')}}" tabindex="-1">CONTACT US</a>
                    </li>
                    <li class="nav-item my-1 my-lg-0">
                        <a class="nav-link {{ request()->routeIs('guest.help') ? 'active' : '' }}"
                           href="{{route('guest.help')}}" tabindex="-1">HELP</a>
                    </li>

                    <div class="d-block d-lg-none">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li class="nav-item my-1 my-lg-0">
                                    <button
                                        class="btn btn-sm py-2 btn-primary"
                                        type="submit">Logout
                                    </button>
                                </li>
                            </form>
                        @endauth

                        @guest
                            <li class="nav-item my-1 my-lg-0">
                                <a href="{{route('register')}}"
                                   class="btn btn-sm py-2 btn-dark" style="width: 100px">SIGN UP</a>
                            </li>
                                <li class="nav-item my-1 my-lg-0">
                                    <a href="{{route('login')}}"
                                       class="btn btn-sm py-2 btn-primary" style="width: 100px">LOGIN
                                    </a>
                                </li>
                        @endguest
                    </div>

                </ul>
                <div class="d-block d-md-flex nav-buttons ms-3 ms-lg-0 d-none d-lg-block">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="btn btn-outline btn-primary px-md-5 px-lg-4 px-xl-5 ms-2 text-white shadow-none text-uppercase"
                                type="submit">Logout
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{route('register')}}" class="btn btn-outline-dark px-md-5 px-lg-4 px-xl-5 py-2">SIGN
                            UP</a>
                        <a href="{{route('login')}}"
                           class="btn btn-outline btn-primary px-md-5 px-lg-4 px-xl-5 py-2 ms-2 text-white shadow-none">LOGIN</a>
                    @endguest
                </div>
            </div>
        </nav>
        <!--    ends    -->

    </div>
</header>

