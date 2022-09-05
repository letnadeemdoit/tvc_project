<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{route('dash.calendar')}}">Calendar</a>
                            </li>
                            <li class="breadcrumb-item"><a class="breadcrumb-link"
                                                           href="{{ route('dash.settings.account-information') }}">Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
                        </ol>
                    </nav>

                    <h1 class="page-header-title">{{ $title ?? '' }}</h1>
                </div>
                {{ $headerRightActions ?? '' }}
            </div>

        </div>

        <!-- End Page Header -->
        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                <div class="navbar-expand-lg navbar-vertical mb-3 mb-lg-5">
                    <!-- Navbar Toggle -->
                    <div class="d-grid">
                        <button type="button" class="navbar-toggler btn btn-white mb-3" data-bs-toggle="collapse"
                                data-bs-target="#navbarVerticalNavMenu" aria-label="Toggle navigation"
                                aria-expanded="false"
                                aria-controls="navbarVerticalNavMenu">
                <span class="d-flex justify-content-between align-items-center">
                  <span class="text-dark">Menu</span>

                  <span class="navbar-toggler-default">
                    <i class="bi-list"></i>
                  </span>

                  <span class="navbar-toggler-toggled">
                    <i class="bi-x"></i>
                  </span>
                </span>
                        </button>
                    </div>
                    <!-- End Navbar Toggle -->

                    <!-- Navbar Collapse -->
                    <div id="navbarVerticalNavMenu" class="collapse navbar-collapse">
                        <ul id="navbarSettings"
                            class="js-sticky-block js-scrollspy card card-navbar-nav nav nav-tabs nav-lg nav-vertical"
                            data-hs-sticky-block-options='{
                     "parentSelector": "#navbarVerticalNavMenu",
                     "targetSelector": "#header",
                     "breakpoint": "lg",
                     "startPoint": "#navbarVerticalNavMenu",
                     "endPoint": "#stickyBlockEndPoint",
                     "stickyOffsetTop": 20
                   }'>
                            @if(!auth()->user()->is_guest)
                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.account-information') }}"
                                       href="{{ route('dash.settings.account-information') }}">
                                        <i class="bi-person nav-icon"></i> Account Information
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.billing') }}"
                                       href="{{ route('dash.settings.billing') }}">
                                        <i class="bi-at nav-icon"></i> Billing
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.users') }}"
                                       href="{{ route('dash.settings.users') }}">
                                        <i class="bi-key nav-icon"></i> Users
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.rooms') }}"
                                       href="{{ route('dash.settings.rooms') }}">
                                        <i class="bi-key nav-icon"></i> Rooms
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.additional-houses') }}"
                                       href="{{ route('dash.settings.additional-houses') }}">
                                        <i class="bi-gear nav-icon"></i> Additional Houses
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.notifications') }}"
                                       href="{{ route('dash.settings.notifications') }}">
                                        <i class="bi-phone nav-icon"></i> Notifications
                                    </a>
                                </li>
                            @endif
                            @if(!auth()->user()->is_guest && auth()->user()->ShowOldSave)
                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.vacations') }}"
                                       href="{{ route('dash.settings.vacations') }}">
                                        <i class="bi-bell nav-icon"></i> Vacations
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.bulletin-boards') }}"
                                       href="{{ route('dash.settings.bulletin-boards') }}">
                                        <i class="bi-bell nav-icon"></i> Bulletin Board
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.audit-history') }}"
                                       href="{{ route('dash.settings.audit-history') }}">
                                        <i class="bi-bell nav-icon"></i> Audit History
                                    </a>
                                </li>
                            @endif
                            @if(!auth()->user()->is_guest)
                                <li class="nav-item">
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.blog') }}"
                                       href="{{ route('dash.settings.blog') }}">
                                        <i class="bi-bell nav-icon"></i> Blog
                                    </a>
                                </li>
                                @if(auth()->user()->is_admin)
                                    <li class="nav-item">
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.guest-books') }}"
                                           href="{{ route('dash.settings.guest-books') }}">
                                            <i class="bi-bell nav-icon"></i> Guest Book
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.category') }}"
                                           href="{{ route('dash.settings.category') }}">
                                            <i class="bi-bell nav-icon"></i> Categories
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                    <!-- End Navbar Collapse -->
                </div>
                <!-- End Navbar -->
            </div>

            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">
                    {{ $slot }}

                    <!-- Card -->
                    {{--                    <div id="deleteAccountSection" class="card">--}}
                    {{--                        <div class="card-header">--}}
                    {{--                            <h4 class="card-title">Delete your account</h4>--}}
                    {{--                        </div>--}}

                    {{--                        <!-- Body -->--}}
                    {{--                        <div class="card-body">--}}
                    {{--                            <p class="card-text">When you delete your account, you lose access to Front account services, and we permanently delete your personal data. You can cancel the deletion for 14 days.</p>--}}

                    {{--                            <div class="mb-4">--}}
                    {{--                                <!-- Form Check -->--}}
                    {{--                                <div class="form-check">--}}
                    {{--                                    <input class="form-check-input" type="checkbox" value="" id="deleteAccountCheckbox">--}}
                    {{--                                    <label class="form-check-label" for="deleteAccountCheckbox">--}}
                    {{--                                        Confirm that I want to delete my account.--}}
                    {{--                                    </label>--}}
                    {{--                                </div>--}}
                    {{--                                <!-- End Form Check -->--}}
                    {{--                            </div>--}}

                    {{--                            <div class="d-flex justify-content-end gap-3">--}}
                    {{--                                <a class="btn btn-white" href="#">Learn more</a>--}}
                    {{--                                <button type="submit" class="btn btn-danger">Delete</button>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <!-- End Body -->--}}
                    {{--                    </div>--}}
                    <!-- End Card -->
                </div>

                <!-- Sticky Block End Point -->
                <div id="stickyBlockEndPoint"></div>
            </div>
        </div>
        <!-- End Row -->
    </div>
    @push('scripts')
        <script>
            $(function () {
                // INITIALIZATION OF STICKY BLOCKS
                // =======================================================
                new HSStickyBlock('.js-sticky-block', {
                    targetSelector: document.getElementById('header').classList.contains('navbar-fixed') ? '#header' : null
                })

                // SCROLLSPY
                // =======================================================
                // new bootstrap.ScrollSpy(document.body, {
                //     target: '#navbarSettings',
                //     offset: 100
                // });
                //
                //     new HSScrollspy('#navbarVerticalNavMenu', {
                //         breakpoint: 'lg',
                //         scrollOffset: -20
                //     })
            })
        </script>
    @endpush
</x-app-layout>
