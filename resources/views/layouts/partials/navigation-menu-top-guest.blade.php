{{--    topnav    --}}
<div class="topnav py-1 bg-topnav">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-center justify-content-md-start">

                    <a href="#"> <i class="fa-brands fa-facebook-f fs-3 text-white pt-1"></i></a>
                    <a href="#">  <i class="bi-twitter mx-3 fs-3 text-white"></i></a>
                    <a href="#"> <i class="bi-instagram fs-3 text-white"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div
                    class="d-block d-md-flex float-end align-items-center w-100 justify-content-center justify-content-md-end">
                    <div
                        class="d-flex align-items-center justify-content-center justify-content-md-start py-1 py-md-0">
                        <i class="fas fa-phone me-2 text-white"></i>
                        <p class="mb-0 text-white fs-12">000-000-000</p>
                    </div>
                    <div
                        class="d-flex align-items-center ms-md-2 ms-4 justify-content-center justify-content-md-start">
                        <img src="{{asset('/images/images-home/Email.svg')}}" class="img-fluid me-2">
                        <p class="mb-0 text-white fs-12">trips.calendar@gmail.com</p>
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
        <nav class="js-mega-menu navbar-nav-wrap d-flex justify-content-center">
            <a class="navbar-brand" href="#">
                <img   class="navbar-brand-logo"
                       src="<?php echo e(asset('logo/logo.png')); ?>"
                       alt="Logo" data-hs-theme-appearance="default" />
            </a>

            <button class="navbar-toggler fs-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="#navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-default">
        <i class="bi-list"></i>
    </span>
                <span class="navbar-toggler-toggled">
        <i class="bi-x"></i>
    </span>
            </button>

            <div class="collapse navbar-collapse align-items-center" id="navbarTogglerDemo02">
                <ul class="navbar-nav  mb-2 mb-lg-0 mx-auto d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('guest.welcome')}}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('guest.privacy-policy')}}">POLICIES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('guest.contact')}}" tabindex="-1">CONTACT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('guest.help')}}" tabindex="-1">HELP</a>
                    </li>


                </ul>
                <div class="d-block d-md-flex nav-buttons ms-4 ms-lg-0">
                    <a href="{{route('register')}}" class="btn btn-outline-dark px-md-5 px-lg-4 px-xl-5">SIGN UP</a>
                    <a href="{{route('login')}}" class="btn btn-outline btn-primary px-md-5 px-lg-4 px-xl-5 ms-2 text-white">LOGIN</a>
                </div>
            </div>
        </nav>
        <!--    ends    -->

    </div>
</header>

