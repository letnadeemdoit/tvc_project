<aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->

            <a class="navbar-brand" href="./index.html" aria-label="Front">
                <img class="img-fluid" src="{{asset('dash/assets/svg/logos/logo.svg')}}" alt="Logo" data-hs-theme-appearance="default">
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
                        <a class="nav-link dropdown-toggle active" href="#navbarVerticalMenuDashboards" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuDashboards" aria-expanded="true" aria-controls="navbarVerticalMenuDashboards">
                            <i class="bi-house-door nav-icon"></i>
                            <span class="nav-link-title">Dashboards</span>
                        </a>

                        <div id="navbarVerticalMenuDashboards" class="nav-collapse collapse show" data-bs-parent="#navbarVerticalMenu">
                            <a class="nav-link active" href="./index.html">The Vacation Calendar</a>
                        </div>
                    </div>
                    <!-- End Collapse -->

                    <span class="dropdown-header mt-4">Navigation</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>
                    <div id="navbarVerticalMenuPagesMenu">

                        <div class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}" data-placement="left">
                                <i class="bi-person nav-icon"></i>
                                <span class="nav-link-title">Users</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link" href="{{route('houses.index')}}" data-placement="left">
                                <i class="bi-house nav-icon"></i>
                                <span class="nav-link-title">Houses</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link" href="./welcome-page.html" data-placement="left">
                                <i class="bi-calendar-month nav-icon"></i>
                                <span class="nav-link-title">Calendar</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link" href="./welcome-page.html" data-placement="left">
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
                                <a class="nav-link " href="{{route('blogs.index')}}">All Blogs</a>
                                <a class="nav-link " href="{{route('blogs.index')}}">Add New Blog</a>
                            </div>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link" href="./welcome-page.html" data-placement="left">
                                <i class="bi-clipboard-data nav-icon"></i>
                                <span class="nav-link-title">Bulletin Board</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesPhotoAlbumsMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesPhotoAlbumsMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesPhotoAlbumsMenu">
                                <i class="bi-images nav-icon"></i>
                                <span class="nav-link-title">Photo Album</span>
                            </a>

                            <div id="navbarVerticalMenuPagesPhotoAlbumsMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuNavigationMenu">
                                <a class="nav-link " href="./Blogs.html">All Photos</a>
                                <a class="nav-link " href="./Blogs-leaderboard.html">Add New Photo</a>
                            </div>
                        </div>


                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesAdministratorMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesAdministratorMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesAdministratorMenu">
                                <i class="bi-person-check nav-icon"></i>
                                <span class="nav-link-title">Administrator</span>
                            </a>

                            <div id="navbarVerticalMenuPagesAdministratorMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuNavigationMenu">
                                <a class="nav-link " href="./Blogs.html">Administer Users</a>
                                <a class="nav-link " href="./Blogs.html">Manage Bulletin Board</a>
                                <a class="nav-link " href="./Blogs.html">Delete Vacation</a>
                                <a class="nav-link " href="./Blogs-leaderboard.html">Help</a>
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
