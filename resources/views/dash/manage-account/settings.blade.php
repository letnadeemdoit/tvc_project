<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Pages</a></li>
                            <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Account</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Settings</li>
                        </ol>
                    </nav>

                    <h1 class="page-header-title">Settings</h1>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto">
                    <a class="btn btn-primary" href="#">
                        <i class="bi-person-fill me-1"></i> My profile
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ link_is_active(route('dash.account.settings')) }}" href="{{ route('dash.account.settings') }}">
                        General
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ link_is_active(route('dash.account.settings')) }}" href="{{ route('dash.account.settings.manage-house') }}">
                        Mange House
                    </a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>

        <!-- End Page Header -->
        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                <div class="navbar-expand-lg navbar-vertical mb-3 mb-lg-5">
                    <!-- Navbar Toggle -->
                    <!-- Navbar Toggle -->
                    <div class="d-grid">
                        <button type="button" class="navbar-toggler btn btn-white mb-3" data-bs-toggle="collapse" data-bs-target="#navbarVerticalNavMenu" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navbarVerticalNavMenu">
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
                    <!-- End Navbar Toggle -->

                    <!-- Navbar Collapse -->
                    <div id="navbarVerticalNavMenu" class="collapse navbar-collapse">
                        <ul id="navbarSettings" class="js-sticky-block js-scrollspy card card-navbar-nav nav nav-tabs nav-lg nav-vertical" data-hs-sticky-block-options='{
                     "parentSelector": "#navbarVerticalNavMenu",
                     "targetSelector": "#header",
                     "breakpoint": "lg",
                     "startPoint": "#navbarVerticalNavMenu",
                     "endPoint": "#stickyBlockEndPoint",
                     "stickyOffsetTop": 20
                   }'>
                            <li class="nav-item">
                                <a class="nav-link active" href="#content">
                                    <i class="bi-person nav-icon"></i> Basic information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#emailSection">
                                    <i class="bi-at nav-icon"></i> Email
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#passwordSection">
                                    <i class="bi-key nav-icon"></i> Password
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#guestPasswordSection">
                                    <i class="bi-key nav-icon"></i> Guest Password
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#preferencesSection">
                                    <i class="bi-gear nav-icon"></i> Preferences
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#recentDevicesSection">
                                    <i class="bi-phone nav-icon"></i> Recent devices
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#notificationsSection">
                                    <i class="bi-bell nav-icon"></i> Notifications
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#deleteAccountSection">--}}
{{--                                    <i class="bi-trash nav-icon"></i> Delete account--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                    <!-- End Navbar Collapse -->
                </div>
                <!-- End Navbar -->
            </div>

            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">
                    <!-- Card -->
                   <livewire:manage-account.settings.profile-photo-form :user="$user"/>
                    <!-- End Card -->

                    <!-- Card -->
                    <livewire:manage-account.settings.update-basic-information-form :user="$user"/>
                    <!-- End Card -->

                    <!-- Card -->
                    <livewire:manage-account.settings.update-email-form :user="$user"/>
                    <!-- End Card -->

                    <!-- Card -->
                    <livewire:manage-account.settings.change-password-form :user="$user"/>
                    <!-- End Card -->

                    <!-- Card -->
                    <livewire:manage-account.settings.guest-password-form :user="$user"/>
                    <!-- End Card -->

                    <!-- Card -->
                    <livewire:manage-account.settings.update-preferences-form :user="$user" />
                    <!-- End Card -->

                    <!-- Card -->
                    <livewire:manage-account.settings.recent-devices-and-logout-other-browser-sessions-form :user="$user"/>
                    <!-- End Card -->

                    <!-- Card -->
                    <livewire:manage-account.settings.update-notification-preferences-form :user="$user" />
                    <!-- End Card -->

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
                new bootstrap.ScrollSpy(document.body, {
                    target: '#navbarSettings',
                    offset: 100
                })

                new HSScrollspy('#navbarVerticalNavMenu', {
                    breakpoint: 'lg',
                    scrollOffset: -20
                })
            })
        </script>
    @endpush
</x-app-layout>
