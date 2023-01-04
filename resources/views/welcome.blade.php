<x-guest-layout>
    @push('stylesheets')

        <style>
            .w-60-h-60 {
                width: 64px !important;
                height: 66px !important;
                object-fit: cover !important;
            }

            .social-feeds .card-text {
                font-size: 12px !important;
            }

            /*.feature-cards .col-lg-4 card{*/
            /*    min-height: 611px;*/
            /*}*/
        </style>
        <style>
            .massonary-container {
                width: 100%;
                display: block;
                margin: 0 auto;
            }

            .masonry {
                column-count: 2;
                column-gap: 5px;
            }

            @media (min-width: 768px) {
                .masonry {
                    column-count: 3;
                }
            }

            @media (min-width: 992px) {
                .masonry {
                    column-count: 4;
                }
            }

            @media (min-width: 1199px) {
                .masonry {
                    column-count: 3;
                }
            }

            @media (min-width: 1400px) {
                .masonry {
                    column-count: 4;
                }
            }

            .masonry .brick {
                box-sizing: border-box;
                -webkit-column-break-inside: avoid;
                page-break-inside: avoid;
                break-inside: avoid;
                counter-increment: brick-counter;
                padding-bottom: 18px;
                margin-left: 6px;
            }

            .masonry img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 6px;
            }

        </style>
        </style>
    @endpush

    <header>
        <div class="position-relative d-flex align-items-center hero-image">
            <div class="container text-center text-md-start">
                <p class="mb-1 display-4 text-primary font-vintage">Keep track of when</p>
                <h1 class="hero-text py-4 poppins-bold text-dark-blue">Your Vacation <br> Home is in Use</h1>
                <a href="{{route('register')}}" class="btn btn-lg btn-signup btn-primary shadow-lg my-2">GET STARTED</a>
                <div class="position-relative mt-5 pt-2 pt-lg-5 max-width">
                    <img src="/images/images-home/rounded-arrow.svg"
                         class="img-fluid position-absolute end-0 mt-n100 d-none d-lg-block" alt="arrow"/>
                    <p class="display-4 font-poppins text-dark-blue fst-italic pt-3">Just Over<span
                            class="text-primary fw-bolder"> $3 </span><span class="fs-6 color-secondary">per
                                month</span></p>
                </div>

            </div>
        </div>
    </header>
    <div class="bg-lightGrey">
        <section>
            <div class="container">
                <div class="row align-items-center padding-y">
                    <div class="col-lg-5 col-xl-4 text-center text-lg-start">
                        <!-- Jumbotron -->
                        <div class="py-4 text-center  rounded mb-0 text-white bg-process-img">
                            <h1 class="h2 text-center text-lg-start text-primary font-vintage mb-0">Get More Enjoyment
                                From Your Vacation Home
                            </h1>
                        </div>
                        <div>
                            <h1 class="poppins-bold pt-2">What is the Vacation Calendar?</h1>
                            <p class="pe-0 pe-lg-4 lh-lg text-light-secondary">The Vacation Calendar is a shared online
                                calendar for families that share a vacation home. Alternatively, if you love having
                                visitors and want to let your friends and family know when there is a good time to come
                                visit, the calendar allows you to share when visitors are coming.

                                The application is also a single point for both important information about your
                                vacation home as well as a great place to share the wonderful experiences everyone has
                                enjoyed when visiting.

                                The main feature is a calendar that allows certain users the ability to specify when
                                they are using the home. But don’t worry, users can only update their own vacations so
                                you can be sure there are no shenanigans that could result in a disagreement on who is
                                using the house. The
                                site also makes it easy for others to request to join an existing vacation or request to
                                use your vacation house when it is not booked.

                                It doesn’t matter whether you are looking for a beach house calendar, ski house
                                calendar, or mountain house calendar, this site works great for anybody looking for a
                                vacation home calendar. Check out the main features below.
                            </p>
                            <a href="{{route('register')}}"
                               class="btn btn-lg btn-signup btn-primary shadow-lg mt-3">SIGN UP</a>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-4 mt-lg-0 offset-lg-1 offset-xl-2 d-none d-lg-block">
                        <div class="text-center d-none d-lg-block">
                            <img src="/images/images-home/left-arrow.svg" class="img-fluid ms-auto mb-3"/>
                        </div>
                        <div
                            class="card  border-0 rounded-3 bg-card-1 me-0 me-lg-3 me-xl-5 margin-top text-center text-lg-start">
                            <div
                                class="d-block text-center d-lg-flex justify-content-center justify-content-lg-start align-items-lg-center h-100 position-absolute w-100">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-1.svg" class="img-fluid" alt="calculator"/>
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Organize who is visiting or using your vacation home</h3>
                                <p class="card-text">Let friends and family see when there are good times to visit or
                                    let them see when the house is not being used so your vacation home is used and
                                    enjoyed more.
                                </p>

                            </div>
                        </div>
                        <div class="text-center d-none d-lg-block">
                            <img src="/images/images-home/right-arrow.svg" class="img-fluid me-auto my-3"/>
                        </div>
                    </div>
                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="card  border-0 my-4 my-lg-0 rounded-3 bg-card-2 margin-y text-center text-lg-start">
                            <div
                                class="d-block  d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-2.svg" class="img-fluid" alt="message"/>
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Share information with the house bulletin board, local guide and
                                    food lists</h3>
                                <p class="card-text">Direct all of your guests to a single location that has all of the
                                    information about the house and the surrounding area.
                                </p>

                            </div>
                        </div>
                        <div class="card  border-0 mt-3 mt-md-5 rounded-3 bg-card-3 text-center text-lg-start">
                            <div
                                class="d-block d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-3.svg" class="img-fluid" alt="users"/>
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Save and share memories of all the enjoyment your vacation home
                                    brings</h3>
                                <p class="card-text">Users can upload photos to the online photo album, share
                                    experiences with house blog entries and even say thank you with the new guest
                                    book.</p>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="d-block d-lg-none mobile-cards">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div
                            class="card  border-0 rounded-3 bg-card-1 me-0 me-lg-3 me-xl-5 margin-top text-center text-lg-start">
                            <div
                                class="d-block text-center d-lg-flex justify-content-center justify-content-lg-start align-items-lg-center h-100 position-absolute w-100">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-1.svg" class="img-fluid" alt="calculator"/>
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Organize your vacation home schedule</h3>
                                <p class="card-text text-light-secondary">Spend more time enjoying your getaway home</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 margin-mobile-card">
                        <div class="card  border-0 rounded-3 bg-card-2 margin-y text-center text-lg-start">
                            <div
                                class="d-block  d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-2.svg" class="img-fluid" alt="message"/>
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Share information on the house bulletin board and house blog</h3>
                                <p class="card-text text-light-secondary">Direct all of your guests to a single location
                                    that has all of the
                                    house
                                    details.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="card  border-0 mt-0 mt-lg-5 rounded-3 bg-card-3 text-center text-lg-start">
                            <div
                                class="d-block d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-3.svg" class="img-fluid" alt="users"/>
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Let friends and family see when they can visit</h3>
                                <p class="card-text text-light-secondary">Allows visitors to see when the house is going
                                    to be free.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--   cards-section   --}}

        <section class="section-min-h bg-cards-section">
            <div class="container pt-5 pt-md-5 pt-lg-3">
                <div
                    class="features-img-2  text-center shadow-1-strong rounded  text-white d-flex justify-content-center align-items-center">
                    <h1 class="text-primary font-vintage mb-0 pt-2">Organize Your Vacation Home</h1>
                </div>
                <h1 class="text-center text-white mt-3">Vacation Calendar makes it simple</h1>
                <div class="row py-5 feature-cards">
                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card p-2 text-center text-lg-start">
                            <img class="card-img-top" src="/images/images-home/bulletin-image-card.svg"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h3 class="card-title">House Bulletin Board</h3>
                                <div style="height: 200px">
                                    <p class="card-text text-light-secondary">The House Bulletin Board is the perfect
                                        solution to that all
                                        important piece paper that is always getting misplaced. This is a great place
                                        for
                                        contact information, house instructions, rules, cleaning services.</p>
                                </div>
                                <div>
                                    <a href="{{ route('guest.help') }}" class="btn btn-lg w-100 btn-primary text-white">Learn
                                        More<i
                                            class="fa-solid fa-arrow-right ps-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <div class="col-lg-4 my-4 my-lg-0">
                        <!-- Card -->
                        <div class="card p-2 text-center text-lg-start">
                            <img class="card-img-top" src="/images/images-home/album-s.svg"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h3 class="card-title">Photo Album</h3>
                                <div style="height: 200px">
                                    <p class="card-text text-light-secondary">One of the most popular features (that
                                        just got a whole lot better!) is the photo album. Users can upload photos to the
                                        album to memorialize the great times. Photos can be put into albums to keep
                                        things nice and organized.</p>
                                </div>
                                <div>
                                    <a href="{{ route('guest.help') }}" class="btn btn-lg w-100 btn-primary text-white">Learn
                                        More <i
                                            class="fa-solid fa-arrow-right ps-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card p-2 text-center text-lg-start">
                            <img class="card-img-top" src="/images/images-home/house-blog-card.svg"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h3 class="card-title">House Blog</h3>
                                <div style="height:200px">
                                    <p class="card-text text-light-secondary">How have you ever lived without a blog for
                                        your vacation home?!?! The House Blog gives everyone a place to share thoughts
                                        and provide updates. Other users can “like” the blog entry and add comments.
                                        It is a great way to keep everyone engaged in what is going on at the house.</p>
                                    {{--                                <p class="card-text text-light-secondary">How have you ever lived without a vacation--}}
                                    {{--                                    home blog?!?! Since the House Bulletin Board is only updated by the administrator of--}}
                                    {{--                                    the house,--}}
                                    {{--                                    the House Blog gives everyone a place to share thoughts, provide updates,<span--}}
                                    {{--                                        class="text-content"> and generally make fun of--}}
                                    {{--                                      each other.</span></p>--}}
                                </div>
                                <div>
                                    <a href="{{ route('guest.help') }}" class="btn btn-lg w-100 btn-primary text-white">Learn
                                        More <i
                                            class="fa-solid fa-arrow-right ps-2"></i></a>
                                </div>

                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
                <div class="row py-5 feature-cards">
                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card p-2 text-center text-lg-start">
                            <img class="card-img-top" src="/images/images-home/local-guide.png"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h3 class="card-title">Local Guide</h3>
                                <div style="height: 200px">
                                    <p class="card-text text-light-secondary">This brand new feature allows users to
                                        create a guide book of any and everything to do, see, eat, etc. in the area.
                                        Each guide book item has space for lots of information and is connected to
                                        Google Maps. Best of all, your users can add ratings so everyone will know the
                                        best places around.
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('guest.help') }}" class="btn btn-lg w-100 btn-primary text-white">Learn
                                        More<i
                                            class="fa-solid fa-arrow-right ps-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <div class="col-lg-4 my-4 my-lg-0">
                        <!-- Card -->
                        <div class="card p-2 text-center text-lg-start">
                            <img class="card-img-top" src="/images/images-home/guest-book.svg"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h3 class="card-title">Guest Book</h3>
                                <div style="height: 200px">
                                    <p class="card-text text-light-secondary">Yes, another new feature in 2022! Inspired
                                        by Dave Navarro who had every guest in house step into his home photo booth.
                                        The thought behind this feature was that families could ask each of their guests
                                        to leave a note in the Guest Book after a stay. Over time you would have a fun
                                        reminder of all the people who visited and enjoyed your vacation home.</p>
                                </div>
                                <div>
                                    <a href="{{ route('guest.help') }}" class="btn btn-lg w-100 btn-primary text-white">Learn
                                        More <i
                                            class="fa-solid fa-arrow-right ps-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card p-2 text-center text-lg-start">
                            <img class="card-img-top" src="/images/images-home/food-item.svg"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h3 class="card-title">Food & Shopping Lists</h3>
                                <div style="height: 200px">
                                    <p class="card-text text-light-secondary">Tracking food in the house can be helpful
                                        especially if you plan on bringing food to your house.
                                        These lists help everyone know what food is already at the house and what needs
                                        to be picked up.</p>
                                </div>
                                <div>
                                    <a href="{{ route('guest.help') }}" class="btn btn-lg w-100 btn-primary text-white">Learn
                                        More <i
                                            class="fa-solid fa-arrow-right ps-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
            </div>
        </section>
        {{-- section 3   --}}

        <section class=" py-2 py-sm-5 bg-white">
            <div class="container mt-2 mt-sm-0">
                <div class="row align-items-center min-height">

                    <div class="col-lg-5">
                        <div
                            class="py-4 text-center shadow-1-strong rounded mb-0 text-white bg-process-img text-margin"/>
                        <h1 class="mb-0 h2 text-center text-lg-start font-vintage text-primary">Customize Your Vacation
                            Home
                        </h1>
                    </div>
                    <div>
                        {{--          nav tabs           --}}
                        <div class="images-nav-tabs  mt-3 mt-md-2 mt-lg-1 row"><!-- tab content -->
                            <div
                                class="col-12 order-2 order-lg-1 tab-content bg-waves min-h-200 text-center text-lg-start"
                                id="myTabContent">
                                <div class="tab-pane fade show active" id="guest-user" role="tabpanel"
                                     aria-labelledby="guest-user">
                                    <h1 class="poppins-bold">House Blog</h1>
                                    <p class="lh-lg text-light-secondary">The Guest User is a single password that you
                                        can share with anyone that you want to be able to see your vacation home site,
                                        but don’t want them to have the ability to schedule vacations. These users are
                                        able to click on an existing
                                        vacation and request to join that vacation or they can click on a day on the
                                        calendar
                                        when there isn’t a scheduled vacation and they can request to use the vacation
                                        home. </p>
                                </div>
                                <div class="tab-pane fade" id="management" role="tabpanel"
                                     aria-labelledby="management-tab">
                                    <h1 class="poppins-bold">User Management</h1>
                                    <p class="lh-lg mb-1 text-light-secondary">One of the most important administrative
                                        functions is managing who can access your site
                                        and what permissions they have. You can create additional Administrators and
                                        Owners. This is also where you can reset your users passwords if they are having
                                        trouble logging in and you can disable users
                                        who you no longer want to have access to the site</p>

                                </div>
                                <div class="tab-pane fade" id="notifications" role="tabpanel"
                                     aria-labelledby="notifications-tab">
                                    <h1 class="poppins-bold">Notifications</h1>
                                    <p class="lh-lg text-light-secondary">Since most users don’t log into
                                        TheVacationCalendar.com on a daily basis, we needed a way so that families can
                                        stay aware of what is happening on the calendar.
                                        An Administrator can add email addresses of the individuals who want to be made
                                        aware of certain events on the site. The most common is getting notified any
                                        time
                                        a vacation is scheduled, updated or deleted. This way no one finds out that the
                                        summer has already been fully scheduled before they have a chance to take a look
                                        and plan their visit.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                                    <h1 class="poppins-bold">Audit History
                                    </h1>
                                    <p class="lh-lg text-light-secondary">This new and powerful feature gives the
                                        Administrator all the information
                                        they can handle about who is using the site and what they are doing. Did someone
                                        say they created a vacation for 10 days but the
                                        calendar only shows 8 days? The audit history will give you the who, what and
                                        when for almost any change to the site.</p>
                                </div>
                                <div class="tab-pane fade" id="houses" role="tabpanel" aria-labelledby="houses-tab">
                                    <h1 class="poppins-bold">Multiple Houses
                                    </h1>
                                    <p class="lh-lg text-light-secondary">This was one of the most common feature
                                        requests over the last few years.
                                        Turns out there are a lot of people looking for a single place to manage the
                                        beach house calendar and ski house calendar.
                                        Or maybe you need to manage multiple cabins or want a separate guest house
                                        calendar.
                                        You can now add multiple properties to your site so that you can manage
                                        everything with a single account. Best of all,
                                        you can look for availability across all the houses from one consolidated
                                        calendar view.</p>
                                </div>
                                <div class="tab-pane fade" id="rooms" role="tabpanel" aria-labelledby="rooms-tab">
                                    <h1 class="poppins-bold">Booking Rooms
                                    </h1>
                                    <p class="lh-lg text-light-secondary">Several years ago, we removed the ability to
                                        allow users to book specific rooms in their house.
                                        Turns out this attempt to simplify the site did not go over well. To make
                                        matters worse, a publication that wrote a story about
                                        TheVacationCalendar.com highlighted the booking rooms functionality so new users
                                        regularly requested that it come back. Well wait
                                        no more! You can specify what rooms your house has for sleeping, the number of
                                        people
                                        that can sleep in each room, and then mark rooms as occupied for different
                                        periods within a vacation. </p>
                                </div>
                                <div class="tab-pane fade" id="subscription" role="tabpanel"
                                     aria-labelledby="subscription-tab">
                                    <h1 class="poppins-bold">Subscription Management
                                    </h1>
                                    <p class="lh-lg text-light-secondary">With all of this new functionality comes some
                                        changes in our pricing including more flexibility.
                                        The original $20 a year price had not changed in 16 years because it covered the
                                        costs of operating the site. We went to an outside
                                        firm to build and support the new site and all the new features so our pricing
                                        needed to change. You can now pay monthly or annually
                                        and you can choose between three tiers of pricing depending on which features
                                        you need. </p>
                                </div>
                                <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                                    <h1 class="poppins-bold">Account Management
                                    </h1>
                                    <p class="lh-lg text-light-secondary">Believe it or not, but there are even more
                                        ways to customize TheVacationCalendar.com
                                        that have not been covered in this dense page of information. The Account
                                        Management page is a catch all
                                        to add some fine tuning to what users can and can’t see as well as manage your
                                        own email and password. Don’t forget to update
                                        your profile picture so your desired image shows up on your vacation dates and
                                        various posts! </p>
                                </div>
                            </div>
                            <!-- tab content ends -->
                            <ul class="col-12 order-1 order-lg-2 mb-4 mb-lg-0 nav nav-tabs border-bottom-0 d-flex justify-content-center justify-content-lg-start mt-2 padding-0"
                                id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="guest-user" data-bs-toggle="tab"
                                            data-bs-target="#guest-user" role="tab" aria-controls="guest-user"
                                            aria-selected="true">
                                        <img src="{{asset('/images/images-home/envelope.svg')}}" class="img-fluid"/>
                                        <p class="mb-0 pt-2 font-poppins">House Blog</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="management-tab" data-bs-toggle="tab"
                                            data-bs-target="#management" role="tab" aria-controls="management"
                                            aria-selected="false">
                                        <img src="{{asset('/images/images-home/card.svg')}}" class="img-fluid"/>
                                        <p class="mb-0 pt-2 font-poppins">User Management</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="notifications-tab" data-bs-toggle="tab"
                                            data-bs-target="#notifications" role="tab" aria-controls="notifications"
                                            aria-selected="true">
                                        <img src="{{asset('/images/images-home/user.svg')}}" class="img-fluid"/>
                                        <p class="mb-0 pt-2 font-poppins">Notifications</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="history-tab" data-bs-toggle="tab"
                                            data-bs-target="#history" role="tab" aria-controls="history"
                                            aria-selected="true">
                                        <img src="{{asset('/images/images-home/user-2.svg')}}" class="img-fluid"/>
                                        <p class="mb-0 pt-2 font-poppins">Audit History</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="houses-tab" data-bs-toggle="tab"
                                            data-bs-target="#houses" role="tab" aria-controls="houses"
                                            aria-selected="true">
                                        <img src="{{asset('/images/images-home/user.svg')}}" class="img-fluid"/>
                                        <p class="mb-0 pt-2 font-poppins">Multiple House</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="rooms-tab" data-bs-toggle="tab"
                                            data-bs-target="#rooms" role="tab" aria-controls="rooms"
                                            aria-selected="true">
                                        <img src="{{asset('/images/images-home/user-2.svg')}}" class="img-fluid"/>
                                        <p class="mb-0 pt-2 font-poppins">Booking Rooms</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="subscription-tab" data-bs-toggle="tab"
                                            data-bs-target="#subscription" role="tab" aria-controls="subscription"
                                            aria-selected="true">
                                        <img src="{{asset('/images/images-home/user.svg')}}" class="img-fluid"/>
                                        <p class="mb-0 pt-2 font-poppins">Subscription Management</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="account-tab" data-bs-toggle="tab"
                                            data-bs-target="#account" role="tab" aria-controls="account"
                                            aria-selected="true">
                                        <img src="{{asset('/images/images-home/user-2.svg')}}" class="img-fluid"/>
                                        <p class="mb-0 pt-2 font-poppins">Account Management</p>
                                    </button>
                                </li>

                            </ul>
                        </div>
                        {{--           nav tabs end             --}}
                    </div>
                </div>

                <div class="col-lg-6 col-xl-5 offset-lg-1 offset-xl-2 text-center">
                    <div id="big-image">
                        <img src="{{asset('/images/images-home/house-blog.png')}}" class="img-fluid" alt="tab-image"/>
                        <img src="{{asset('/images/images-home/user-management.png')}}" class="img-fluid"
                             alt="tab-image"/>
                        <img src="{{asset('/images/images-home/notifications1.png')}}" class="img-fluid"
                             alt="tab-image"/>
                        <img src="{{asset('/images/images-home/audit.png')}}" class="img-fluid"
                             alt="tab-image"/>
                        <img src="{{asset('/images/images-home/houses.png')}}" class="img-fluid" alt="tab-image"/>
                        <img src="{{asset('/images/images-home/booking-room1.png')}}" class="img-fluid"
                             alt="tab-image"/>
                        <img src="{{asset('/images/images-home/subscription1.png')}}" class="img-fluid"
                             alt="tab-image"/>
                        <img src="{{asset('/images/images-home/manage-account.png')}}" class="img-fluid"
                             alt="tab-image"/>
                    </div>


                </div>
            </div>


        </section>
        <section class="p-2 p-lg-5 bg-social-feed social-feeds" style="border-bottom:2px solid #FFFFFF27">
            <div class="container">
                <div
                    class="mt-70 mb-2 text-center shadow-1-strong rounded  text-white social-img d-flex justify-content-center align-items-center">
                    <h1 class="text-primary font-vintage pt-2 mb-0">Find Your Vacation House</h1>
                </div>
                <h1 class="text-center text-white">See our blogs.</h1>

                <div class="row mt-5">
                    @if(isset($blogs) && count($blogs) > 0)
                        @foreach($blogs as $blog)
                            <div class="col-12 col-md-6 col-lg-3 mb-4 item">
                                <div class="card blog-card">
                                    <div class="w-100">
                                        <a href="{{route('guest.blog.show', $blog->slug)}}">
                                            <img
                                                {{--                src="{{ $post->getFileUrl() }}"--}}

                                                @if(isset($blog->image) && !is_null($blog->image))
                                                src="{{$blog->getFileUrl()}}"
                                                @else
                                                src="{{$blog->getFileUrl('image')}}"
                                                @endif

                                                class="card-img-top  position-relative"
                                                style="height: 310px !important;object-fit: cover" alt="..."/>
                                        </a>
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="w-90 mx-auto margin-negative bg-white position-relative z-index-2 px-3 py-3 rounded-1"
                                             style="min-height: 150px">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="user-img d-flex align-items-center">
                                                    @if(!empty($blog->user->profile_photo_url) && !is_null($blog->user->profile_photo_url))
                                                        <img
                                                            src="{{ $blog->user->profile_photo_url }}"
                                                            class="avatar-initials img-fluid position-relative rounded-3"
                                                            alt="{{ $blog->user->name ?? '' }}"
                                                            style="width:50px !important;height:50px !important;object-fit: cover;"
                                                        >
                                                    @else
                                                        <img
                                                            src="/images/blog-images/beach.png"
                                                            class="avatar-initials img-fluid position-relative rounded-circle"
                                                            alt="..."
                                                            style="width:50px !important;height:50px !important;object-fit: cover;"
                                                        >
                                                    @endif

                                                    <div class="ps-3">
                                                        <h5 class="mb-1 fw-bold"
                                                            style="color: #2A3342">{{ Str::upper('By '.$blog->user->first_name. ' ' .$blog->user->last_name[0] ?? '')  }}</h5>
                                                        <p class="mb-0 fs-13 txt-clr">{{\Carbon\Carbon::parse($blog->BlogDate)->format('d M Y')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="paragraph-text pt-3 text-black">
                                                <h5 class="mb-1 fw-500"
                                                    style="color: #2A3342">{{ Str::limit($blog->Subject, 50) }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                {{--                <div class="d-flex justify-content-between margin-tb ">--}}
                {{--                    <div class="w-100 m-2">--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-1.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('/images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-2.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('/images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-3.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('/images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}

                {{--                    </div>--}}
                {{--                    <div class="w-100 m-2">--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/2-1.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('/images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/2-2.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('/images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/2-3.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('/images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}

                {{--                    </div>--}}
                {{--                    <div class="w-100 m-2">--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/3-1.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/3-2.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/4-1.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}

                {{--                    </div>--}}
                {{--                    <div class="w-100 m-2">--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/4-1.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/4-2.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/4-4.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}

                {{--                    </div>--}}
                {{--                    <div class="w-100 m-2">--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/5-1.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/5-2.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}

                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                        <!-- Card -->--}}
                {{--                        <div class="card border-0 mb-3">--}}
                {{--                            <div class="card-pinned">--}}
                {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/5-3.png')}}" alt="Image Description">--}}

                {{--                                <div class="card-pinned-bottom-start">--}}
                {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="card-body">--}}
                {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a>--}}
                {{--                                </h3>--}}
                {{--                                <p class="card-text">Learn the simplest way to select the object and change--}}
                {{--                                    dimensions.</p>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <!-- End Card -->--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>

            {{--            <div class="container d-block d-lg-none">--}}
            {{--                <div class="mt-70 mb-2 text-center shadow-1-strong rounded  text-white social-img d-flex justify-content-center align-items-center">--}}
            {{--                    <h1 class="text-primary font-vintage pt-2 mb-0">Find Your Vacation House</h1>--}}
            {{--                </div>--}}
            {{--                <h1 class="text-center text-white">See our social media feed.</h1>--}}

            {{--                <div class="row margin-tb ">--}}

            {{--                    <div class="col-12 col-md-6">--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-1.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-2.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-3.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}

            {{--                    </div>--}}

            {{--                    <div class="col-12 col-md-6">--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/4-1.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-2.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-3.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}

            {{--                    </div>--}}

            {{--                    <div class="col-12 col-md-6">--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/3-1.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/3-2.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-3.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}

            {{--                    </div>--}}

            {{--                    <div class="col-12 col-md-6">--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/4-1.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/1-3.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}
            {{--                        <!-- Card -->--}}
            {{--                        <div class="card border-0 mb-3">--}}
            {{--                            <div class="card-pinned">--}}
            {{--                                <img class="card-img-top" src="{{asset('/images/news-feed/4-4.png')}}" alt="Image Description">--}}

            {{--                                <div class="card-pinned-bottom-start">--}}
            {{--                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60" src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="card-body">--}}
            {{--                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
            {{--                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- End Card -->--}}

            {{--                    </div>--}}

            {{--                    <div class="col-12 col-md-6">--}}

            {{--                    </div>--}}

            {{--                </div>--}}
            {{--            </div>--}}
        </section>
        {{--        <section class="d-none">--}}
        {{--            <div class="masonry pt-55">--}}
        {{--                <div class="brick me-1 pe-1">--}}
        {{--                    <div class="card border-0 mb-1">--}}
        {{--                        <div class="card-pinned">--}}
        {{--                            <img class="card-img-top" src="{{asset('images/news-feed/1-1.png')}}" alt="Image Description"/>--}}

        {{--                            <div class="card-pinned-bottom-start">--}}
        {{--                                <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"--}}
        {{--                                     src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="card-body">--}}
        {{--                            <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
        {{--                            <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}

        {{--                </div>--}}
        {{--                <div class="brick me-1 pe-1">--}}
        {{--                    <div class="card border-0 mb-1">--}}
        {{--                        <div class="card-pinned">--}}
        {{--                            <img class="card-img-top" src="{{asset('images/news-feed/5-3.png')}}" alt="Image Description"/>--}}

        {{--                            <div class="card-pinned-bottom-start">--}}
        {{--                                <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"--}}
        {{--                                     src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="card-body">--}}
        {{--                            <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
        {{--                            <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="brick me-1 pe-1">--}}
        {{--                    <div class="card border-0 mb-1">--}}
        {{--                        <div class="card-pinned">--}}
        {{--                            <img class="card-img-top" src="{{asset('images/news-feed/5-3.png')}}" alt="Image Description"/>--}}

        {{--                            <div class="card-pinned-bottom-start">--}}
        {{--                                <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"--}}
        {{--                                     src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="card-body">--}}
        {{--                            <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
        {{--                            <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="brick me-1 pe-1">--}}
        {{--                    <div class="card border-0 mb-1">--}}
        {{--                        <div class="card-pinned">--}}
        {{--                            <img class="card-img-top" src="{{asset('images/news-feed/4-1.png')}}" alt="Image Description"/>--}}

        {{--                            <div class="card-pinned-bottom-start">--}}
        {{--                                <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"--}}
        {{--                                     src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="card-body">--}}
        {{--                            <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
        {{--                            <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="brick me-1 pe-1">--}}
        {{--                    <div class="card border-0 mb-1">--}}
        {{--                        <div class="card-pinned">--}}
        {{--                            <img class="card-img-top" src="{{asset('images/news-feed/4-2.png')}}" alt="Image Description"/>--}}

        {{--                            <div class="card-pinned-bottom-start">--}}
        {{--                                <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"--}}
        {{--                                     src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="card-body">--}}
        {{--                            <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
        {{--                            <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="brick me-1 pe-1">--}}
        {{--                    <div class="card border-0 mb-1">--}}
        {{--                        <div class="card-pinned">--}}
        {{--                            <img class="card-img-top" src="{{asset('images/news-feed/4-4.png')}}" alt="Image Description"/>--}}

        {{--                            <div class="card-pinned-bottom-start">--}}
        {{--                                <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"--}}
        {{--                                     src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="card-body">--}}
        {{--                            <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
        {{--                            <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="brick me-1 pe-1">--}}
        {{--                    <div class="card border-0 mb-1">--}}
        {{--                        <div class="card-pinned">--}}
        {{--                            <img class="card-img-top" src="{{asset('images/news-feed/5-2.png')}}" alt="Image Description"/>--}}

        {{--                            <div class="card-pinned-bottom-start">--}}
        {{--                                <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"--}}
        {{--                                     src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="card-body">--}}
        {{--                            <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
        {{--                            <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="brick me-1 pe-1">--}}
        {{--                    <div class="card border-0 mb-1">--}}
        {{--                        <div class="card-pinned">--}}
        {{--                            <img class="card-img-top" src="{{asset('images/news-feed/3-1.png')}}" alt="Image Description"/>--}}

        {{--                            <div class="card-pinned-bottom-start">--}}
        {{--                                <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"--}}
        {{--                                     src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="card-body">--}}
        {{--                            <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
        {{--                            <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="brick me-1 pe-1">--}}
        {{--                    <div class="card border-0 mb-1">--}}
        {{--                        <div class="card-pinned">--}}
        {{--                            <img class="card-img-top" src="{{asset('images/news-feed/3-2.png')}}" alt="Image Description"/>--}}

        {{--                            <div class="card-pinned-bottom-start">--}}
        {{--                                <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"--}}
        {{--                                     src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="card-body">--}}
        {{--                            <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>--}}
        {{--                            <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}
        @push('scripts')
            <script>
                $(function () {
                    $("#big-image img:eq(0)").nextAll().hide();
                    $(".images-nav-tabs .nav-item").click(function (e) {
                        var index = $(this).index();
                        $("#big-image img").eq(index).show().siblings().hide();
                    });
                });
            </script>
            <script>
                $("#toggle").on("click", function () {
                    $(".text-content").toggleClass("show");
                });
            </script>
            <script>
                $('.moreless-button').click(function () {
                    $('.moretext').slideToggle();
                    if ($('.moreless-button').text() == "Read more") {
                        $(this).text("Read less")
                    } else {
                        $(this).text("Read more")
                    }
                });
            </script>
    @endpush
</x-guest-layout>
