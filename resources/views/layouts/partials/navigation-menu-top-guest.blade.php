{{--    topnav    --}}
<div class="topnav py-2 bg-dark">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-center justify-content-md-start">

                    <i class="bi-facebook fs-3 text-white"></i>
                    <i class="bi-twitter mx-3 fs-3 text-white"></i>
                    <i class="bi-instagram fs-3 text-white"></i>

                </div>
            </div>
            <div class="col-md-6">
                <div
                    class="d-block d-md-flex float-end align-items-center w-100 justify-content-center justify-content-md-end">
                    <div
                        class="d-flex align-items-center justify-content-center justify-content-md-start py-2 py-md-0">
                        <i class="fas fa-phone me-2"></i>
                        <p class="mb-0 text-white">000-000-000</p>
                    </div>
                    <div
                        class="d-flex align-items-center ms-md-2 ms-4 justify-content-center justify-content-md-start">
                        <i class="fa-solid fa-envelope me-2"></i>
                        <p class="mb-0 text-white">trips.calendar@gmail.com</p>
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

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="#navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-default">
        <i class="bi-list"></i>
    </span>
                <span class="navbar-toggler-toggled">
        <i class="bi-x"></i>
    </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav  mb-2 mb-lg-0 mx-auto d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">POLICIES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/" tabindex="-1">CONTACT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/" tabindex="-1">HELP</a>
                    </li>


                </ul>
                <div class="d-block d-md-flex nav-buttons">
                    <a href="/" class="btn btn-outline-dark px-md-5 px-lg-4 px-xl-5" type="submit">SIGN UP</a>
                    <a href="/" class="btn btn-outline bg-primary px-md-5 px-lg-4 px-xl-5 ms-3 text-white" type="submit">LOGIN</a>
                </div>
            </div>
        </nav>
        <!--    ends    -->

    </div>
</header>
