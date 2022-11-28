<header
    id="header"
    class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white"
    x-data="{avatarUrl: '{{ auth()->user()->profile_photo_url }}'}"
    @refresh-avatar.window="avatarUrl = $event.detail.profile_photo_url"
>
    <div class="navbar-nav-wrap">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dash.calendar') }}" aria-label="{{ config('app.name') }}">
            <img class="navbar-brand-logo d-none d-md-block" src="{{ asset('logo/logo.jpg') }}"
                 alt="{{ config('app.name') }}"/>
            <img class="navbar-brand-logo d-md-none"


                 type="button" data-bs-toggle="collapse"
                 data-bs-target="#navbarTogglerDemo02" aria-controls="#navbarTogglerDemo02" aria-expanded="false"
                 aria-label="Toggle navigation"


                 style="min-width: 48px !important;max-width: 48px" src="{{ asset('logo/favicon.jpg') }}"
                 alt="{{ config('app.name') }}"/>
        </a>
        <!-- End Logo -->

        <div class="navbar-nav-wrap-content-start">
            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align"
                   data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                   data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align"
                   data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                   data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->
        </div>



        @if(auth()->user()->is_admin)
            @if(request()->cookie('switched_from_primary_account') == 'yes')
                <div class="d-flex justify-content-start d-none d-lg-block">
    {{--                <span class="fw-semi-bold text-primary">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}!</span>--}}
                    <form method="POST" action="{{ route('dash.switch-house') }}">
                    @method('PUT')
                    @csrf

                    <!-- Hidden Team ID -->
                        <input type="hidden" name="house_id" value="{{ primary_user()->HouseId }}">
                        <button type="submit" class="bg-transparent border-0 text-light-grey fw-500 fs-12">
                            You are currently in <span class="fw-600 text-primary">{{ auth()->user()->house->HouseName }}</span> house
                            <Span class="text-decoration-underline text-primary">Click to go Primary house</Span>
                        </button>
                    </form>
                </div>

            @endif
        @endif


        <div class="navbar-nav-wrap-content-end">
            <!-- Navbar -->
            <ul class="navbar-nav">
                @if(!auth()->user()->is_guest && !auth()->user()->is_super_admin)
                    @php
                        $data = auth()->user()->unreadNotifications()->get();
                    @endphp
                    <li class="nav-item me-1 me-md-3">
                        <a href="{{ route('dash.notifications') }}"
                           class="btn btn-ghost-secondary btn-icon rounded-circle bg-light-primary">
                            <i class="bi-bell text-primary"></i>
                            @if(count($data) > 0)
                                <span class="btn-status btn-sm-status btn-status-danger"></span>
                            @endif
                        </a>
                    </li>
                @endif

                @if(auth()->user()->is_admin)
                    <li class="nav-item">
                        <!-- Account -->
                        <div class="dropdown">
                            <a class="btn btn-soft-primary btn-sm dropdown-toggle" href="javascript:;"
                               id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                               data-bs-auto-close="outside" data-bs-dropdown-animation>
                                <i class="bi bi-house-fill me-1 fs-13"></i>
                                <span class="d-none d-md-inline-block">
                                    Properties
                                    @if(auth()->user()->house->primary_house_name !== null and auth()->user()->house->primary_house_name !== '')
                                        ({{ auth()->user()->house->primary_house_name }})
                                    @else
                                        <span class="ps-1">
                                             ({{ auth()->user()->house->HouseName }})
                                        </span>
                                    @endif
                                </span>
                            </a>

                            <div
                                class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                                aria-labelledby="accountNavbarDropdown"
                                style="width: 16rem;margin-top: 53px !important;">
                                <div class="dropdown-item-text">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm avatar-circle">
                                            <img
                                                class="rounded-circle"
                                                style="width: 45px;height: 45px"
                                                src="{{ auth()->user()->house->getFileUrl() }}"
                                                alt="{{ auth()->user()->house->HouseName }}"

                                            />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mb-0">
                                                @if(auth()->user()->house->primary_house_name !== null and auth()->user()->house->primary_house_name !== '')
                                                    {{ auth()->user()->house->primary_house_name }}
                                                    ({{ auth()->user()->house->HouseName }})
                                                @else
                                                    {{ auth()->user()->house->HouseName }}
                                                @endif

                                            </h5>
                                            <p class="card-text text-body">{{ auth()->user()->house->address }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if(!auth()->user()->is_guest)
                                    <a class="dropdown-item"
                                       href="{{ route('dash.settings.house-setting') }}">
                                        <i class="bi bi-gear-wide-connected me-1"></i>Settings</a>
                                    <div class="dropdown-divider"></div>
                                @endif
                                @if(is_premium_subscribed())
                                    <div class="px-3">
                                        @foreach(auth()->user()->additional_houses as $additionalHouse)
                                            <x-switchable-property :house="$additionalHouse"/>
                                            @if(!$loop->last)
                                                <hr class="p-0 m-0 my-2">
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                @endif
                <li class="nav-item">
                    <!-- Account -->
                    <div class="dropdown">
                        <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                           data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                           data-bs-dropdown-animation>
                            <div class="avatar avatar-sm avatar-circle">
                                <img
                                    class="avatar-img"
                                    src="{{ auth()->user()->profile_photo_url }}"
                                    :src="avatarUrl"
                                    alt="Image"
                                />
                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                            </div>
                        </a>

                        <div
                            class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                            aria-labelledby="accountNavbarDropdown" style="width: 16rem; margin-top: 48px">
                            <div class="dropdown-item-text px-1">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-circle w-25">
                                        <img
                                            class="avatar-img"
                                            src="{{ auth()->user()->profile_photo_url }}"
                                            :src="avatarUrl"
                                            alt="Image"
                                            style="object-fit: cover;"
                                        />
                                    </div>
                                    <div class="flex-grow-1 ms-3 text-break">
                                        <h5 class="mb-0">{{Auth::user()->user_name ?? ''}}</h5>
                                        <p class="card-text text-body">{{Auth::user()->email ?? ''}}</p>
                                    </div>
                                </div>
                            </div>


                            @if(auth()->user()->is_super_admin)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('super-admin.manage-users') }}">Manage Users</a>
                            @endif

                            @if(!auth()->user()->is_guest)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('dash.settings.account-information') }}">Settings</a>
                            @endif
                            <div class="dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Sign out</button>
                            </form>
                        </div>
                    </div>
                    <!-- End Account -->
                </li>

                <li class="nav-item">
                    <button class="navbar-toggler text-primary p-0 border-0" type="button" data-bs-toggle="collapse"
                            style="font-size: 24px !important;"

                            data-bs-target="#navbarTogglerDemo02" aria-controls="#navbarTogglerDemo02"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                <span class="navbar-toggler-default">
                    <i class="bi-list text-primary"></i>
                </span>
                        <span class="navbar-toggler-toggled">
                 <i class="bi-x text-primary"></i>
                 </span>
                    </button>
                </li>
            </ul>
            <!-- End Navbar -->
        </div>


    </div>
</header>

<header class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white mt-62 h-40"
>
    <nav class="js-mega-menu navbar-nav-wrap w-100">
        <div class="collapse navbar-collapse align-items-center" id="navbarTogglerDemo02">
            <ul class="navbar-nav mb-2 mb-lg-0 shadow-sm-screen mx-auto d-flex justify-content-center guest-menu dashboard-guest-menu"
                style="z-index: 999 !important;">
                @auth

                    @if(!auth()->user()->is_super_admin )

                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('dash.calendar')}}">ADMIN</a>
                        </li>

                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.guest-calendar')}}">CALENDAR</a>
                        </li>

                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.bulletin-board.index')}}">BULLETIN BOARD</a>
                        </li>

                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.blog.index')}}" tabindex="-1">BLOG</a>
                        </li>
                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.photo-album.index')}}" tabindex="-1">PHOTO ALBUM</a>
                        </li>
                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.local-guide.index')}}" tabindex="-1">LOCAL GUIDE</a>
                        </li>
                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.house-items.index')}}" tabindex="-1">FOOD ITEMS</a>
                        </li>
                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.guest-book.index')}}" tabindex="-1">GUEST BOOK</a>
                        </li>

                        <div class="dropdown">
                            <a class="navbar-dropdown-account-wrapper fw-500 px-2 ms-lg-0 me-2 me-lg-1 pb-0 dropdown-focus"
                               href="javascript:;"
                               id="moreMenuList"
                               style="color: #677788"
                               data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                               data-bs-dropdown-animation>
                                More<img src="{{asset('/images/images-home/arrow-down.svg')}}" class="img-fluid"
                                         width="20"/>
                            </a>

                            <ul class="dropdown-menu border-0" aria-labelledby="moreMenuList">
                                <li class="nav-item my-1 my-lg-0">
                                    <a class="dropdown-item fw-500"
                                       href="{{route('guest.privacy-policy')}}">POLICIES</a>
                                </li>
                                <li class="nav-item my-1 my-lg-0">
                                    <a class="dropdown-item fw-500"
                                       href="{{route('guest.contact')}}" tabindex="-1">CONTACT US</a>
                                </li>
                                <li class="nav-item my-1 my-lg-0">
                                    <a class="dropdown-item fw-500"
                                       href="{{route('guest.help')}}" tabindex="-1">HELP</a>
                                </li>
                            </ul>
                        </div>

                    @endif

                    @if(auth()->user()->is_super_admin )

                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.welcome')}}">HOME</a>
                        </li>

                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.privacy-policy')}}">POLICIES</a>
                        </li>
                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.contact')}}" tabindex="-1">CONTACT US</a>
                        </li>
                        <li class="nav-item my-1 my-lg-0">
                            <a class="nav-link fw-500"
                               href="{{route('guest.help')}}" tabindex="-1">HELP</a>
                        </li>


                    @endif

                @endauth

            </ul>
        </div>
    </nav>

    @if(auth()->user()->is_admin)
        @if(request()->cookie('switched_from_primary_account') == 'yes')

            <div class="d-block d-lg-none">
                {{--                <span class="fw-semi-bold text-primary">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}!</span>--}}
                <form method="POST" class="text-center mx-auto" action="{{ route('dash.switch-house') }}">
                @method('PUT')
                @csrf

                <!-- Hidden Team ID -->
                    <input type="hidden" name="house_id" value="{{ primary_user()->HouseId }}">
                    <button type="submit" class="bg-transparent border-0 text-light-grey fw-500 fs-11">
                        You are currently in  <span class="fw-600 text-primary">{{ auth()->user()->house->HouseName }}</span> house
                        <Span class="text-decoration-underline text-primary">Click to go Primary house</Span>
                    </button>
                </form>
            </div>

        @endif
    @endif

</header>


