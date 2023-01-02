{{--    topnav    --}}
<div class="topnav py-1 bg-topnav  d-none d-md-block">
    <div class="container">
        <div class="row align-items-center primary-hover">
            <div class="col-lg-3 d-inline text-center text-lg-start">
                <a href="https://www.facebook.com/thevacationcalendar"> <i
                        class="fa-brands fa-facebook-f fs-3 text-white pt-1"></i></a>
                <a href="https://twitter.com/TheVacationCal"> <i class="bi-twitter mx-3 fs-3 text-white"></i></a>
                <a href="https://www.instagram.com/thevacationcalendar/"> <i
                        class="bi-instagram fs-3 text-white"></i></a>
                <a href="https://www.youtube.com/channel/UCXxQTnfwdvMX-Yb30X-WpYQ"> <i
                        class="bi-youtube mx-3 fs-3 text-white"></i></a>
                {{--                <ul class="list-unstyled d-flex mb-0">--}}
                {{--                    <li>--}}
                {{--                        <a href="#"> <i class="fa-brands fa-facebook-f fs-3 text-white pt-1"></i></a>--}}
                {{--                    </li>--}}
                {{--                    <li>--}}
                {{--                        <a href="#"> <i class="bi-twitter mx-3 fs-3 text-white"></i></a>--}}
                {{--                    </li>--}}
                {{--                    <li><a href="#"> <i class="bi-instagram fs-3 text-white"></i></a></li>--}}
                {{--                </ul>--}}
            </div>
            <div class="col-lg-9">
                <div
                    class="d-block d-md-flex float-end align-items-center w-100 justify-content-center justify-content-lg-end">
                    @auth
                        <div
                            class="py-1 py-md-0 pe-3">
                            <a href="{{route('guest.privacy-policy')}}" class="mb-0 text-white fs-12">Policies</a>
                        </div>
                        <div
                            class="py-1 py-md-0 pe-3">
                            <a href="{{route('guest.help')}}" class="mb-0 text-white fs-12">Help</a>
                        </div>
                        <div
                            class="py-1 py-md-0 pe-3">
                            <a href="{{route('guest.contact')}}" class="mb-0 text-white fs-12">Contact us</a>
                        </div>
                    @endauth

                    <div
                        class="py-1 py-md-0 pe-3">
{{--                        <a href="tel:0000-000-0" class="mb-0 text-white fs-12">--}}
{{--                            <i class="fa-solid fa-phone me-2 text-white fs-4"></i> 000-000-000</a>--}}
                    </div>
                    <div>
                        <a class="mb-0 text-white fs-12" href="mailto:support@thevacationcalendar.com">
                            <i class="fa-regular fa-envelope text-white fs-5 px-2"></i>
                            support@thevacationcalendar.com
                        </a>
                    </div>
                    {{--                    <ul class="list-unstyled d-flex mb-0">--}}
                    {{--                        <li> <a href="tel:0000-000-0" class="mb-0 text-white fs-12 px-3">--}}
                    {{--                                <i class="fas fa-phone  text-white pe-2"></i> 000-000-000</a>--}}
                    {{--                        </li>--}}
                    {{--                        <li> <a class="mb-0 text-white fs-12" href="mailto:someone@example.com">--}}
                    {{--                                <i class="fa-regular fa-envelope text-white pe-3"></i>trips.calendar@gmail.com--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{{--   topnnav     --}}

<header id="header" class="navbar navbar-expand-lg navbar-bordered bg-white ">
    <div class="container">
        <nav class="js-mega-menu navbar-nav-wrap d-flex justify-content-center justify-content-lg-end py-1 login-nav">
            <a class="navbar-brand" href="{{route('guest.welcome')}}">
                <img class="navbar-brand-logo"
                     src="{{ asset('logo/logo.jpg') }}"
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
                <ul class="navbar-nav  mb-2 mb-lg-0 mx-auto d-flex justify-content-center guest-menu">

                    @auth

                        @if(!auth()->user()->is_guest && !auth()->user()->is_owner && !auth()->user()->is_super_admin && !auth()->user()->is_admin)
                            <li class="nav-item my-1 my-lg-0">
                                <a class="nav-link {{ request()->routeIs('guest.welcome') ? 'active' : '' }}"
                                   href="{{route('guest.welcome')}}">HOME</a>
                            </li>
                        @endif

                    @else

                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link {{ request()->routeIs('guest.welcome') ? 'active' : '' }}"
                               href="{{route('guest.welcome')}}">HOME</a>
                        </li>

                    @endauth

                    @auth

                        @if(!auth()->user()->is_super_admin )

                            {{--                            <li class="nav-item my-1 my-lg-0">--}}
                            {{--                                <a class="nav-link {{ request()->routeIs('dash.calendar') ? 'active' : '' }}"--}}
                            {{--                                   href="{{route('dash.calendar')}}">Admin</a>--}}
                            {{--                            </li>--}}

                            @if(!auth()->user()->is_guest)
                            <li class="nav-item my-1 my-lg-0 me-0">
                                <a class="nav-link {{ request()->routeIs('dash.calendar') ? 'active' : '' }}"
                                   href="{{route('dash.calendar')}}">ADMIN</a>
                            </li>
                            @endif

                            <li class="nav-item my-1 my-lg-0 me-0">
                                <a class="nav-link {{ request()->routeIs('guest.guest-calendar') ? 'active' : '' }}"
                                   href="{{route('guest.guest-calendar')}}">CALENDAR</a>
                            </li>

                            <li class="nav-item my-1 my-lg-0 me-0">
                                <a class="nav-link {{ request()->routeIs('guest.bulletin-board.index') ? 'active' : '' }}"
                                   href="{{route('guest.bulletin-board.index')}}">BULLETIN BOARD</a>
                            </li>

                            <li class="nav-item my-1 my-lg-0 me-0">
                                <a class="nav-link {{ request()->routeIs('guest.blog.index') || request()->routeIs('guest.blog.show') ? 'active' : '' }}"
                                   href="{{route('guest.blog.index')}}" tabindex="-1">BLOG</a>
                            </li>
                            <li class="nav-item my-1 my-lg-0 me-0">
                                <a class="nav-link {{ request()->routeIs('guest.photo-album.index') || request()->routeIs('guest.photo-album.show') ? 'active' : '' }}"
                                   href="{{route('guest.photo-album.index')}}" tabindex="-1">PHOTO ALBUM</a>
                            </li>
                            <li class="nav-item my-1 my-lg-0 me-0">
                                <a class="nav-link {{ request()->routeIs('guest.local-guide.index') || request()->routeIs('guest.local-guide.show') ? 'active' : '' }}"
                                   href="{{route('guest.local-guide.index')}}" tabindex="-1">LOCAL GUIDE</a>
                            </li>
                            <li class="nav-item my-1 my-lg-0 me-0">
                                <a class="nav-link {{ request()->routeIs('guest.house-items.index') ? 'active' : '' }}"
                                   href="{{route('guest.house-items.index')}}" tabindex="-1">FOOD</a>
                            </li>
                            <li class="nav-item my-1 my-lg-0 me-0">
                                <a class="nav-link {{ request()->routeIs('guest.guest-book.index') ? 'active' : '' }}"
                                   href="{{route('guest.guest-book.index')}}" tabindex="-1">GUEST BOOK</a>
                            </li>

{{--                            <div class="dropdown">--}}

{{--                                <a class="navbar-dropdown-account-wrapper ms-3 ms-lg-0 nav-link pb-0 dropdown-focus"--}}
{{--                                   href="javascript:;"--}}
{{--                                   id="moreMenuList"--}}
{{--                                   style="font-size: 15px; color: #606368 !important;"--}}
{{--                                   data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"--}}
{{--                                   data-bs-dropdown-animation>--}}
{{--                                    More<img src="{{asset('/images/images-home/arrow-down.svg')}}" class="img-fluid"--}}
{{--                                             width="20"/>--}}
{{--                                </a>--}}

{{--                                <ul class="dropdown-menu border-0" aria-labelledby="moreMenuList">--}}
{{--                                    <li class="nav-item my-1 my-lg-0">--}}
{{--                                        <a class="dropdown-item fw-500 {{ request()->routeIs('guest.guest-book.index') ? 'active' : '' }}"--}}
{{--                                           href="{{route('guest.guest-book.index')}}" tabindex="-1">GUEST BOOK</a>--}}
{{--                                    </li>--}}

{{--                                    <li class="nav-item my-1 my-lg-0">--}}
{{--                                        <a class="dropdown-item fw-500"--}}
{{--                                           href="{{route('guest.privacy-policy')}}">POLICIES</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item my-1 my-lg-0">--}}
{{--                                        <a class="dropdown-item fw-500"--}}
{{--                                           href="{{route('guest.contact')}}" tabindex="-1">CONTACT US</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item my-1 my-lg-0">--}}
{{--                                        <a class="dropdown-item fw-500"--}}
{{--                                           href="{{route('guest.help')}}" tabindex="-1">HELP</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}

                        @endif

                        @if(auth()->user()->is_super_admin )

                            <li class="nav-item my-1 my-lg-0">
                                <a class="nav-link {{ request()->routeIs('guest.welcome') ? 'active' : '' }}"
                                   href="{{route('guest.welcome')}}">HOME</a>
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

                        @endif

                    @endauth

                    @guest

                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link {{ request()->routeIs('guest.privacy-policy') ? 'active' : '' }}"
                               href="{{route('guest.privacy-policy')}}">POLICIES</a>
                        </li>
                            <li class="nav-item my-1 my-lg-0">
                                <a class="nav-link {{ request()->routeIs('guest.pricing') ? 'active' : '' }}"
                                   href="{{route('guest.pricing')}}">PRICING</a>
                            </li>
                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link {{ request()->routeIs('guest.contact') ? 'active' : '' }}"
                               href="{{route('guest.contact')}}" tabindex="-1">CONTACT US</a>
                        </li>
                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link {{ request()->routeIs('guest.help') ? 'active' : '' }}"
                               href="{{route('guest.help')}}" tabindex="-1">HELP</a>
                        </li>

                    @endguest

                    @auth
                        <li class="nav-item my-1 my-lg-0 d-lg-none">
                            <a class="nav-link {{ request()->routeIs('guest.privacy-policy') ? 'active' : '' }}"
                               href="{{route('guest.privacy-policy')}}">POLICIES</a>
                        </li>

                        <li class="nav-item my-1 my-lg-0 d-lg-none">
                            <a class="nav-link {{ request()->routeIs('guest.help') ? 'active' : '' }}"
                               href="{{route('guest.help')}}" tabindex="-1">HELP</a>
                        </li>

                        <li class="nav-item my-1 my-lg-0 d-lg-none">
                            <a class="nav-link {{ request()->routeIs('guest.contact') ? 'active' : '' }}"
                               href="{{route('guest.contact')}}" tabindex="-1">CONTACT US</a>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item my-1 my-lg-0 d-block d-lg-none">
                            <a href="{{route('register')}}"
                               class="btn btn-sm py-2 btn-dark" style="width: 100px">SIGN UP</a>
                        </li>
                        <li class="nav-item my-1 my-lg-0 d-block d-lg-none">
                            <a href="{{route('login')}}"
                               class="btn btn-sm py-2 btn-primary" style="width: 100px">LOGIN
                            </a>
                        </li>
                    @endguest
                </ul>

                <div class="d-md-flex nav-buttons ms-3 ms-lg-0 ">
                @auth
                    <!-- Account -->
                        <div class="dropdown  d-flex  align-items-center">

                            <div class="avatar avatar-sm avatar-circle">
                                <img
                                    class="avatar-img"
                                    src="{{ auth()->user()->profile_photo_url }}"
                                    :src="avatarUrl"
                                    alt="Image"
                                />
                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                            </div>
                            {{--                            <p class="mb-0 px-0 px-lg-3 py-2 py-lg-0 d-none d-lg-block">Guest</p>--}}
                            <h5 class="mb-0 d-none d-lg-block px-0 px-lg-3">{{Auth::user()->first_name ?? ''}}</h5>
                            <a class="navbar-dropdown-account-wrapper ms-3 ms-lg-0 dropdown-focus" href="javascript:;"
                               id="accountNavbarDropdown"
                               data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                               data-bs-dropdown-animation>
                                <img src="{{asset('/images/images-home/arrow-down.svg')}}" class="img-fluid"/>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account start-0"
                                aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                                {{--                                <div class="dropdown-item-text">--}}
                                {{--                                    <div class="d-flex align-items-center">--}}
                                {{--                                        --}}{{--                                        <div class="avatar avatar-sm avatar-circle">--}}
                                {{--                                        --}}{{--                                            <img class="avatar-img" src="{{asset('images/avatar.png')}}"--}}
                                {{--                                        --}}{{--                                                 alt="Image Description">--}}
                                {{--                                        --}}{{--                                        </div>--}}
                                {{--                                        <div class="flex-grow-1 ms-3">--}}
                                {{--                                            <h5 class="mb-0  d-block d-lg-none">{{Auth::user()->user_name ?? ''}}</h5>--}}
                                {{--                                            --}}{{--                                            <p class="card-text text-body">{{Auth::user()->email ?? ''}}</p>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="dropdown-divider d-none"></div>

                                @if(!auth()->user()->is_super_admin && !auth()->user()->is_guest )
                                    <a href="{{route('dash.calendar')}}" class="dropdown-item"> <i
                                            class="bi bi-calendar-week me-2"></i>Calendar</a>
                                @endif

                                @if(!auth()->user()->is_guest)
                                    <a href="{{route('dash.settings.')}}" class="dropdown-item"><i
                                            class="bi bi-gear me-2"></i>Settings</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i
                                            class="bi bi-box-arrow-left me-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- End Account -->
                    @else
                        <a href="{{route('register')}}"
                           class="btn d-none d-lg-block btn-outline-dark px-md-5 px-lg-4 px-xl-5 py-2">SIGN UP
                        </a>
                        <a href="{{route('login')}}"
                           class="btn d-none d-lg-block btn-outline btn-primary px-md-5 px-lg-4 px-xl-5
                            py-2 ms-2 text-white shadow-none">LOGIN
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</header>

