<aside
    class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->

            <a class="navbar-brand" href="{{route('guest.welcome')}}" aria-label="Front">
                <img class="img-fluid" src="{{asset('logo/logo.svg')}}" alt="Logo" data-hs-theme-appearance="default">
            </a>

            <!-- End Logo -->

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

            <!-- Content -->
            <div class="navbar-vertical-content">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                    <!-- Collapse -->
                    <div class="nav-item">
{{--                        <a class="nav-link active" href="{{route('dash.index')}}">--}}
{{--                            <i class="bi-house-door nav-icon"></i>--}}
{{--                            <span class="nav-link-title">Dashboard</span>--}}
{{--                        </a>--}}
                        <div class="nav-item">
                            <a class="nav-link" href="{{route('dash.calendar')}}" data-placement="left">
{{--                                <i class="bi-calendar-month nav-icon"></i>--}}
                                <img src="{{asset('images/icons/calendar.svg')}}" class="me-3" style="width: 16px;opacity: 0.7" alt="">

                                <span class="nav-link-title">Calendar</span>
                            </a>
                        </div>
                    </div>
                    <!-- End Collapse -->

                    <span class="dropdown-header mt-4">Menu</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>
                    @if(auth()->user()->is_guest)

                        <div class="nav-item">
                            <a class="nav-link  {{ link_is_active_with_class(['guest.welcome']) }}" href="{{route('guest.welcome')}}" data-placement="left">
                                {{--                                    <i class="bi-router nav-icon"></i>--}}
                                <img src="{{asset('images/icons/pricing-icon.svg')}}" class="me-3" style="width: 16px;opacity: 0.7" alt="">
                                <span class="nav-link-title">Home</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link  {{ link_is_active_with_class(['guest.bulletin-board.index']) }}" href="{{route('guest.bulletin-board.index')}}" data-placement="left">
                                {{--                                    <i class="bi-router nav-icon"></i>--}}
                                <img src="{{asset('images/icons/pricing-icon.svg')}}" class="me-3" style="width: 16px;opacity: 0.7" alt="">
                                <span class="nav-link-title">Bulletin Board</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link  {{ link_is_active_with_class(['guest.blog.index']) }}" href="{{route('guest.blog.index')}}" data-placement="left">
                                {{--                                    <i class="bi-router nav-icon"></i>--}}
                                <img src="{{asset('images/icons/pricing-icon.svg')}}" class="me-3" style="width: 16px;opacity: 0.7" alt="">
                                <span class="nav-link-title">Blog</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link  {{ link_is_active_with_class(['guest.photo-album.index']) }}" href="{{route('guest.photo-album.index')}}" data-placement="left">
                                {{--                                    <i class="bi-router nav-icon"></i>--}}
                                <img src="{{asset('images/icons/photo-album.svg')}}" class="me-3" style="width: 16px;opacity: 0.7" alt="">
                                <span class="nav-link-title">Photo Album</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link  {{ link_is_active_with_class(['guest.local-guide.index']) }}" href="{{route('guest.local-guide.index')}}" data-placement="left">
                                {{--                                    <i class="bi-router nav-icon"></i>--}}
                                <img src="{{asset('images/icons/mdi_map-marker-radius-outline.svg')}}" class="me-3" style="width: 18px;opacity: 0.7" alt="">
                                <span class="nav-link-title">Local Guide</span>
                            </a>
                        </div>


                        <div class="nav-item">
                            <a class="nav-link  {{ link_is_active_with_class(['guest.house-items.index']) }}" href="{{route('guest.house-items.index')}}" data-placement="left">
                                {{--                                    <i class="bi-router nav-icon"></i>--}}
                                <img src="{{asset('images/icons/pricing-icon.svg')}}" class="me-3" style="width: 16px;opacity: 0.7" alt="">
                                <span class="nav-link-title">Food List</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link  {{ link_is_active_with_class(['guest.guest-book.index']) }}" href="{{route('guest.guest-book.index')}}" data-placement="left">
                                {{--                                    <i class="bi-router nav-icon"></i>--}}
                                <img src="{{asset('images/icons/pricing-icon.svg')}}" class="me-3" style="width: 16px;opacity: 0.7" alt="">
                                <span class="nav-link-title">Guest Book </span>
                            </a>
                        </div>


                    @endif

                    <div id="navbarVerticalMenuPagesMenu">
                        @if(!auth()->user()->is_guest)
                            <div class="nav-item">
                                <a class="nav-link {{ link_is_active_with_class(['dash.photo-albums']) }}" href="{{route('dash.photo-albums')}}" data-placement="left">
{{--                                    <i class="bi-images nav-icon"></i>--}}
                                    <img src="{{asset('images/icons/photo-album.svg')}}" class="me-3" style="width: 18px;opacity: 0.7" alt="">
                                    <span class="nav-link-title">Photo Albums</span>
                                </a>
                            </div>

                            <div class="nav-item">
                                <a class="nav-link  {{ link_is_active_with_class(['dash.local-guide']) }}" href="{{route('dash.local-guide')}}" data-placement="left">
{{--                                    <i class="bi-calendar-month nav-icon"></i>--}}
                                    <img src="{{asset('images/icons/mdi_map-marker-radius-outline.svg')}}" class="me-3" style="width: 18px;opacity: 0.7" alt="">

                                    <span class="nav-link-title">Local Guide</span>
                                </a>
                            </div>
                        @endif
                        @if(auth()->user()->is_admin)
                            <div class="nav-item">
                                <a class="nav-link  {{ link_is_active_with_class(['dash.plans-and-pricing']) }}" href="{{route('dash.plans-and-pricing')}}" data-placement="left">
{{--                                    <i class="bi-router nav-icon"></i>--}}
                                    <img src="{{asset('images/icons/pricing-icon.svg')}}" class="me-3" style="width: 16px;opacity: 0.7" alt="">
                                    <span class="nav-link-title">Plans &amp; Pricing</span>
                                </a>
                            </div>
                        @endif
                        @if(!auth()->user()->is_guest)
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle {{ link_is_active_with_class(['dash.food-item-list', 'dash.shopping-item-list']) }}
                                    "
                                   href="#navbarVerticalHouseItemList" role="button" data-bs-toggle="collapse"
                                   data-bs-target="#navbarVerticalHouseItemList" aria-expanded="false"
                                   aria-controls="navbarVerticalMenuPagesAdministratorMenu">
{{--                                    <i class="bi-house nav-icon"></i>--}}
                                    <img src="{{asset('images/icons/house-items-icon.svg')}}" class="me-3" style="width: 18px;opacity: 0.7" alt="">

                                    <span class="nav-link-title">House Items</span>
                                </a>

                                <div id="navbarVerticalHouseItemList"
                                     class="nav-collapse collapse {{ link_is_active_with_class(['dash.food-item-list', 'dash.shopping-item-list'], 'show') }}"
                                     data-bs-parent="#navbarVerticalHouseItemList">
                                    <a class="nav-link {{ link_is_active_with_class('dash.food-item-list') }}"
                                       href="{{route('dash.food-item-list')}}">Food in the house</a>
                                    <a class="nav-link {{ link_is_active_with_class('dash.shopping-item-list') }}"
                                       href="{{route('dash.shopping-item-list')}}">Food Shopping List</a>
                                </div>
                            </div>
                        @endif
                        @if(!auth()->user()->is_guest)
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle {{ link_is_active_with_class(['dash.account.settings', 'dash.account.subscriptions', 'dash.account.invoices']) }}"
                                   href="#navbarVerticalMenuPagesAccountMenu" role="button" data-bs-toggle="collapse"
                                   data-bs-target="#navbarVerticalMenuPagesAccountMenu" aria-expanded="false"
                                   aria-controls="navbarVerticalMenuPagesAdministratorMenu">
{{--                                    <i class="bi-person-check nav-icon"></i>--}}
                                    <img src="{{asset('images/icons/settings-icon.svg')}}" class="me-3" style="width: 16px;opacity: 0.7" alt="">

                                    <span class="nav-link-title">Settings</span>
                                </a>

                                {{--                            <div id="navbarVerticalMenuPagesAccountMenu" class="nav-collapse collapse {{ link_is_active_with_class(['dash.account.settings', 'dash.account.subscriptions', 'dash.account.invoices'], 'show') }}" data-bs-parent="#navbarVerticalMenuPagesAccountMenu">--}}
                                {{--                                <a class="nav-link {{ link_is_active_with_class('dash.account.settings') }}" href="{{ route('dash.account.settings') }}">Settings</a>--}}
                                {{--                                <a class="nav-link {{ link_is_active_with_class('dash.account.subscriptions') }}" href="{{ route('dash.account.subscriptions') }}">Subscriptions</a>--}}
                                {{--                                <a class="nav-link {{ link_is_active_with_class('dash.account.invoices') }}" href="{{ route('dash.account.invoices') }}">Invoices</a>--}}
                                {{--                            </div>--}}

                                <div id="navbarVerticalMenuPagesAccountMenu"
                                     class="nav-collapse collapse {{ link_is_active_with_class(['dash.settings.account-information', 'dash.settings.billing', 'dash.settings.users', 'dash.settings.rooms', 'dash.settings.additional-houses', 'dash.settings.notifications', 'dash.settings.vacations', 'dash.settings.bulletin-boards', 'dash.settings.audit-history', 'dash.settings.blog', 'dash.settings.guest-books','dash.settings.category'], 'show') }}"
                                     data-bs-parent="#navbarVerticalMenuPagesAccountMenu">

                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.account-information') }}"
                                           href="{{ route('dash.settings.account-information') }}">
                                            @if(auth()->user()->is_admin)
                                                Account Information
                                            @else
                                                Manage Account
                                            @endif
                                        </a>
                                    @if(auth()->user()->is_admin)
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.billing') }}"
                                           href="{{ route('dash.settings.billing') }}">Billing</a>

                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.users') }}"
                                           href="{{ route('dash.settings.users') }}">Users</a>
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.rooms') }}"
                                           href="{{ route('dash.settings.rooms') }}">Rooms</a>
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.additional-houses') }}"
                                           href="{{ route('dash.settings.additional-houses') }}">Additional Houses</a>
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.notifications') }}"
                                           href="{{ route('dash.settings.notifications') }}">Notifications</a>
                                    @endif
                                    @if(!auth()->user()->is_guest && auth()->user()->ShowOldSave)
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.vacations') }}"
                                           href="{{ route('dash.settings.vacations') }}">Vacations</a>
                                    @endif
                                    @if(auth()->user()->is_admin)
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.bulletin-boards') }}"
                                           href="{{ route('dash.settings.bulletin-boards') }}">Bulletin Board</a>
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.audit-history') }}"
                                           href="{{ route('dash.settings.audit-history') }}">Audit History</a>
                                    @endif
                                    <a class="nav-link {{ link_is_active_with_class('dash.settings.blog') }}"
                                       href="{{ route('dash.settings.blog') }}">Blog</a>
                                    @if(auth()->user()->is_admin)
                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.guest-books') }}"
                                           href="{{ route('dash.settings.guest-books') }}">Guest Book</a>

                                        <a class="nav-link {{ link_is_active_with_class('dash.settings.category') }}"
                                           href="{{ route('dash.settings.category') }}">Categories</a>
                                    @endif
                                </div>
                            </div>
                        @endif
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
