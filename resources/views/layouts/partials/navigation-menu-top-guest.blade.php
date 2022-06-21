<header id="header" class="navbar navbar-expand-lg navbar-bordered bg-white  ">
    <div class="container">
        <nav class="js-mega-menu navbar-nav-wrap">
            <!-- Logo -->

            <a class="navbar-brand" href="{{ url('/') }}" aria-label="Front">
                <img
                    class="navbar-brand-logo"
                    src="{{ asset('logo/logo.png') }}"
                    alt="Logo" data-hs-theme-appearance="default"
                />
                {{--                <img class="navbar-brand-logo" src="../assets/svg/logos-light/logo.svg" alt="Logo" data-hs-theme-appearance="dark">--}}
            </a>

            <!-- End Logo -->

            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-secondary-content">
                <!-- Navbar -->
                <ul class="navbar-nav fs-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" data-placement="left">
                            <i class="bi-book bi-box-arrow-right"></i> Signup
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" data-placement="left">
                            <i class="bi-book bi-box-arrow-in-right"></i> Signin
                        </a>
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarContainerNavDropdown" aria-controls="navbarContainerNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-default">
                    <i class="bi-list"></i>
                </span>
                <span class="navbar-toggler-toggled">
                    <i class="bi-x"></i>
                </span>
            </button>
            <!-- End Toggler -->

            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarContainerNavDropdown">
                <ul class="navbar-nav fs-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" data-placement="left">
                            <i class="bi-book bi-house-fill"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" data-placement="left">
                            <i class="bi-book bi-clipboard-data"></i> Bulletin Board
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guest.contact') }}" data-placement="left">
                            <i class="bi-book bi-envelope-fill"></i> Contact Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" data-placement="left">
                            <i class="bi-book bi-journal-album"></i> Albums
                        </a>
                    </li>
                </ul>

            </div>
            <!-- End Collapse -->
        </nav>
    </div>
</header>
