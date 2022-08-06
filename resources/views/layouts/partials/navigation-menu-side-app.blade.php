<aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->

            <a class="navbar-brand" href="{{route('guest.welcome')}}" aria-label="Front">
                <img class="img-fluid" src="{{asset('logo/logo.svg')}}" alt="Logo" data-hs-theme-appearance="default">
            </a>

            <!-- End Logo -->

            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->

            <!-- Content -->
            <div class="navbar-vertical-content">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                    <!-- Collapse -->
                    <div class="nav-item">
                        <a class="nav-link active" href="{{route('dash.index')}}">
                            <i class="bi-house-door nav-icon"></i>
                            <span class="nav-link-title">Dashboard</span>
                        </a>

                    </div>
                    <!-- End Collapse -->

                    <span class="dropdown-header mt-4">Menu</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>
                    <div id="navbarVerticalMenuPagesMenu">

                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('dash.users.index') }}" data-placement="left">
                                <i class="bi-person nav-icon"></i>
                                <span class="nav-link-title">Users</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link" href="{{route('dash.houses')}}" data-placement="left">
                                <i class="bi-house nav-icon"></i>
                                <span class="nav-link-title">Houses</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link" href="#" data-placement="left">
                                <i class="bi-calendar-month nav-icon"></i>
                                <span class="nav-link-title">Calendar</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link" href="#" data-placement="left">
                                <i class="bi-sunset nav-icon"></i>
                                <span class="nav-link-title">Vacations</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesBlogsMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesBlogsMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesBlogsMenu">
                                <i class="bi-bootstrap nav-icon"></i>
                                <span class="nav-link-title">Blogs</span>
                            </a>

                            <div id="navbarVerticalMenuPagesBlogsMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                <a class="nav-link " href="{{route('dash.blogs')}}">All Blogs</a>
                            </div>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesBulletinMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesBulletinMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesBulletinMenu">
                                <i class="bi-bootstrap nav-icon"></i>
                                <span class="nav-link-title">Bulletins</span>
                            </a>

                            <div id="navbarVerticalMenuPagesBulletinMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesBulletinMenu">
                                <a class="nav-link " href="{{route('dash.bulletins')}}">Bulletins</a>
                            </div>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle {{ link_is_active_with_class(['dash.photo-albums']) }} " href="#navbarVerticalMenuPagesPhotoAlbumsMenu" role="button" data-bs-toggle="collapse"
                               data-bs-target="#navbarVerticalMenuPagesPhotoAlbumsMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesPhotoAlbumsMenu">
                                <i class="bi-images nav-icon"></i>
                                <span class="nav-link-title">Photo Albums</span>
                            </a>

                            <div id="navbarVerticalMenuPagesPhotoAlbumsMenu" class="nav-collapse collapse {{ link_is_active_with_class(['dash.photo-albums'], 'show') }}"
                                 data-bs-parent="#navbarVerticalMenuNavigationMenu">
                                <a class="nav-link {{ link_is_active_with_class('dash.photo-albums') }} " href="{{route('dash.photo-albums')}}">All Photos</a>
                            </div>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesBookMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesBookMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesBookMenu">
                                <i class="bi-bootstrap nav-icon"></i>
                                <span class="nav-link-title">Guest Book</span>
                            </a>

                            <div id="navbarVerticalMenuPagesBookMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                <a class="nav-link " href="{{route('dash.guest-book')}}">Guest Book</a>
                            </div>
                        </div>


                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle {{ link_is_active_with_class(['dash.account.settings', 'dash.account.subscriptions', 'dash.account.invoices']) }}" href="#navbarVerticalMenuPagesAccountMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesAccountMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesAdministratorMenu">
                                <i class="bi-person-check nav-icon"></i>
                                <span class="nav-link-title">Settings</span>
                            </a>

{{--                            <div id="navbarVerticalMenuPagesAccountMenu" class="nav-collapse collapse {{ link_is_active_with_class(['dash.account.settings', 'dash.account.subscriptions', 'dash.account.invoices'], 'show') }}" data-bs-parent="#navbarVerticalMenuPagesAccountMenu">--}}
{{--                                <a class="nav-link {{ link_is_active_with_class('dash.account.settings') }}" href="{{ route('dash.account.settings') }}">Settings</a>--}}
{{--                                <a class="nav-link {{ link_is_active_with_class('dash.account.subscriptions') }}" href="{{ route('dash.account.subscriptions') }}">Subscriptions</a>--}}
{{--                                <a class="nav-link {{ link_is_active_with_class('dash.account.invoices') }}" href="{{ route('dash.account.invoices') }}">Invoices</a>--}}
{{--                            </div>--}}
                            <div id="navbarVerticalMenuPagesAccountMenu" class="nav-collapse collapse {{ link_is_active_with_class(['dash.settings.account-information', 'dash.settings.billing', 'dash.settings.users', 'dash.settings.rooms', 'dash.settings.additional-homes', 'dash.settings.notifications', 'dash.settings.vacations', 'dash.settings.bulletin-board', 'dash.settings.audit-history', 'dash.settings.blog', 'dash.settings.guest-book'], 'show') }}" data-bs-parent="#navbarVerticalMenuPagesAccountMenu">
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.account-information') }}" href="{{ route('dash.settings.account-information') }}">Account Information</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.billing') }}" href="{{ route('dash.settings.billing') }}">Billing</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.users') }}" href="{{ route('dash.settings.users') }}">Users</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.rooms') }}" href="{{ route('dash.settings.rooms') }}">Rooms</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.additional-homes') }}" href="{{ route('dash.settings.additional-homes') }}">Additional Homes</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.notifications') }}" href="{{ route('dash.settings.notifications') }}">Notifications</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.vacations') }}" href="{{ route('dash.settings.vacations') }}">Vacations</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.bulletin-board') }}" href="{{ route('dash.settings.bulletin-board') }}">Bulletin Board</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.audit-history') }}" href="{{ route('dash.settings.audit-history') }}">Audit History</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.blog') }}" href="{{ route('dash.settings.blog') }}">Blog</a>
                                <a class="nav-link {{ link_is_active_with_class('dash.settings.guest-book') }}" href="{{ route('dash.settings.guest-book') }}">Guest Book</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Content -->

            <!-- Footer -->
            <div class="navbar-vertical-footer">

            </div>
            <!-- End Footer -->
        </div>
    </div>
</aside>
