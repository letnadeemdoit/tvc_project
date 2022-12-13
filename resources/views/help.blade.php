<x-guest-layout>
    <!-- Hero -->
@include('partials.sub-page-hero-section', ['title' => 'Help'])
<!-- End Hero -->

    <!-- FAQ -->
    <section class="bg-crystals mb-6rem">
        <div class="container content-space-2 content-space-b-lg-3">
            <!-- nav tabs -->
            <section class="text-center">
                <div class="help-text shadow-1-strong rounded  d-flex justify-content-center">
                    <h1 class="text-primary font-vintage mb-0">Help</h1>
                </div>
                <h2 class="pt-2 poppins-bold mb-0">Get Instructions Here</h2>
            </section>
            <div class="help-page-tabs mt-80">
                <div class="bg-border">
                    <ul class="nav nav-tabs  border-bottom-0 d-flex justify-content-center" id="myTab" role="tablist">
                        <!-- <div class="row">  -->
                        <!-- <div class="col-3">  -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="price-tab" data-bs-toggle="tab" data-bs-target="#price"
                                    type="button" role="tab" aria-controls="price" aria-selected="true">
                                <div class="card shadow-lg card-border rounded-3 mt-0">
                                    <div class="card-body">
                                        <img src="{{asset('/images/help-images/menu-book.svg')}}"
                                             class="img-fluid m-auto">
                                        <p>Pricing</p>
                                    </div>
                                </div>
                                {{--                            <div class="text-end bg-arrow d-none d-lg-block">--}}
                                {{--                                <img src="{{asset('/images/help-images/vector-1.png')}}" class="img-fluid">--}}
                                {{--                            </div>--}}
                            </button>
                        </li>
                        <!-- </div>  -->
                        <!-- <div class="col-3"> -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">
                                <div class="card shadow-lg card-border rounded-3 mt-lg-5">
                                    <div class="card-body">
                                        <img src="{{asset('/images/help-images/menu-book.svg')}}"
                                             class="img-fluid m-auto">
                                        <p>Quick Start Guide</p>
                                    </div>
                                </div>
                                {{--                            <div class="text-end bg-arrow d-none d-lg-block">--}}
                                {{--                                <img src="{{asset('/images/help-images/vector-1.png')}}" class="img-fluid">--}}
                                {{--                            </div>--}}
                            </button>
                        </li>
                        <!-- </div>  -->
                        <!-- <div class="col-3"> -->

                        <li class="nav-item " role="presentation">
                            <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users"
                                    type="button" role="tab" aria-controls="users" aria-selected="false">
                                <div class="card shadow-lg card-border rounded-3 mt-lg-n1 ">
                                    <div class="card-body">
                                        <img src="{{asset('/images/help-images/users.svg')}}" class="img-fluid  m-auto">
                                        <p><span class="d-none d-lg-block">Understanding the different Roles</span>
                                        </p>
                                    </div>
                                </div>
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact" aria-selected="false">
                                <div class="card shadow-lg card-border rounded-3 mt-0 mt-lg-5  ">
                                    <div class="card-body">
                                        <img src="{{asset('/images/help-images/vacation-calendar.svg')}}"
                                             class="img-fluid m-auto">
                                        <p><span class="d-none d-lg-block">Detailed Instructions</span></p>
                                    </div>
                                </div>
                                {{--                            <div class="text-end bg-arrow d-none d-lg-block">--}}
                                {{--                                <img src="{{asset('/images/help-images/vector-3.png')}}" class="img-fluid">--}}
                                {{--                            </div>--}}
                            </button>
                        </li>
                        <!-- </div>  -->
                        <!-- <div class="col-3">  -->

                        <!-- </div>  -->
                        <!-- </div> -->
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="price" role="tabpanel" aria-labelledby="price-tab">
                    <div class="accordion-section mt-80">
                        <div class="container">
                            <div class="m-0 m-lg-4">
                                <div class="accordion" id="myAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne">Pricing
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                             data-bs-parent="#myAccordion">
                                            <div class="card-body bottom-box-shadow">

                                                <p>
                                                    TheVacationCalendar.com had the same pricing of <span
                                                        class="text-primary fw-bold">$20</span> per year from its
                                                    inception in 2007 through 2022. In 2022, we hired an amazing
                                                    development firm to completely rebuild the site to bring it up to
                                                    date with today’s standard websites. A single account can now manage
                                                    rooms within a house, manage multiple rooms and continue to support
                                                    as many users as needed.
                                                    To offset the cost of the 30+ person development team as well as to
                                                    cover other increasingly higher expenses, the site has a new pricing
                                                    model.
                                                </p>
                                                <div class="table-responsive mb-5">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th class="text-center" scope="col">Price
                                                                (billed Monthly)
                                                            </th>
                                                            <th class="text-center" scope="col">Price
                                                                (billed Annually)
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">Basic</th>
                                                            <td class="text-center">$5</td>
                                                            <td class="text-center">$40</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Standard</th>
                                                            <td class="text-center">$7</td>
                                                            <td class="text-center">$60</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Premium</th>
                                                            <td class="text-center">$9</td>
                                                            <td class="text-center">$80</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Trial Period</th>
                                                            <td class="text-center">7 days</td>
                                                            <td class="text-center">20 days</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th class="w-25" scope="col">Functionality</th>
                                                            <th class="w-25 text-center" scope="col">Basic</th>
                                                            <th class="w-25 text-center" scope="col">Standard</th>
                                                            <th class="w-25 text-center" scope="col">Premium</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">Calendar</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Bulletin Board</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Blog</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Photo Album</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Local Guide</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Food Items</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Guest Book</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Booking Rooms</th>
                                                            <td class="text-center">-</td>
                                                            <td class="text-center">Up to 6 rooms</td>
                                                            <td class="text-center">Unlimited rooms</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Additional Properties</th>
                                                            <td class="text-center">-</td>
                                                            <td class="text-center">-</td>
                                                            <td class="text-center">Up to 9 properties</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="accordion-section mt-80">
                        <div class="container">
                            <div class="m-0 m-lg-4">
                                <div class="accordion" id="myAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne">Quick Start
                                                Guide for Administrators
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                             data-bs-parent="#myAccordion">
                                            <div class="card-body bottom-box-shadow">
                                                <p>
                                                    Here are the steps to quickly get your house up and running quickly.
                                                    For a more thorough understanding of the website please go to
                                                    the Detailed Instructions which provides instructions both written
                                                    and in short videos so you can understand how all the features work.
                                                </p>

                                                <div class="g-ytsubscribe my-3"
                                                     data-channelid="UCXxQTnfwdvMX-Yb30X-WpYQ" data-layout="full"
                                                     data-count="hidden"></div>

                                                <h3 class="mt-3">Set up administrator capabilities</h3>
                                                <p>
                                                    Start by going to the Admin page from the top navigation. This gives
                                                    you access to all the features and the settings pages. Expand the
                                                    Settings menu option on the left navigation and go to Account
                                                    Information. Here you have several configuration options, but to
                                                    start if you, as an administrator, also want to be able
                                                    to schedule vacations as an owner. If you do, simply toggle the
                                                    "Allow Administrator to have Owner permissions" toggle.
                                                </p>

                                                <h3>Create additional users for your house</h3>
                                                <p>
                                                    Also under Settings is the Users screen which you use to create
                                                    additional Owners by assigning them usernames and passwords. These
                                                    users will be able to schedule vacations and add content to the
                                                    house such as adding photos, blog entries, local guides, etc. You
                                                    can also update your Guest password here. And, if you want to share
                                                    the Administrator
                                                    responsibilities with someone else, you can set up additional
                                                    Administrators who will have full control of the site.
                                                </p>

                                                <h3>Set up the bulletin board</h3>
                                                <p>
                                                    Only the Administrator can add content to the bulletin board. The
                                                    bulletin board setup page is also on the left hand navigation menu
                                                    under the Admin section. This is the perfect spot to put house
                                                    rules,
                                                    list important contact information, share the Wifi password, provide
                                                    directions to the house, etc.
                                                </p>

                                                <h3>Create Photo Albums</h3>
                                                <p>
                                                    If you would like to have your Photo Albums well organized, you can
                                                    set these up in the Photo Albums page on the left hand navigation
                                                    menu under the Admin section. Maybe you want to organize your photos
                                                    by year, or by family event, or whatever. Setting these up ahead of
                                                    time will help keep it nice and organized.
                                                </p>

                                                <h3>Set up Categories</h3>
                                                <p>
                                                    If you like things well organized, you can add categories to Blog
                                                    Entries, Local Guide and the Bulletin Board. Only the Administrator
                                                    can create these categories and
                                                    it will allow your users to quickly filter down these sections to
                                                    the content they are looking for.
                                                </p>

                                                <h3>Tell your friends</h3>
                                                <p>
                                                    Feel free to share the name of your vacation home and the guest
                                                    password to as many people as you like. This will give them basic
                                                    access to see the calendar and the memories you are saving
                                                    for your ski house, beach house, lake house, mountain house, or
                                                    whatever vacation home you have.
                                                </p>

                                                <h3>Learn about and request new features</h3>
                                                <p>
                                                    We primarily share new features on Facebook but also use other
                                                    social media sites. Follow us on our
                                                    <a href="https://www.facebook.com/thevacationcalendar">Facebook</a>
                                                    page to stay up to date and contribute to our growing community of
                                                    users.
                                                    Please use the Contact Us form to suggest new features or request
                                                    help if something is not working the way you expected.
                                                </p>

                                                <div class="fb-like"
                                                     data-href="https://www.facebook.com/thevacationcalendar/"
                                                     data-width="" data-layout="standard" data-action="like"
                                                     data-size="small" data-share="true"></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mt-3">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button type="button" class="accordion-button collapsed"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo">Quick Start Guide for Owners
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion">
                                            <div class="card-body bottom-box-shadow">
                                                <p class="mb-3">
                                                    Here are the steps to take advantage of your shared vacation home.
                                                    This site provides you with a lot more capabilities than just having
                                                    a shared calendar for your vacation home. TheVacationCalendar.com
                                                    allows you to capture and share memories. For a more thorough
                                                    understanding of the website please go to the Detailed
                                                    Instructions which provides instructions both written and in short
                                                    videos so you can understand how all the features work.
                                                </p>

                                                <div class="g-ytsubscribe" data-channelid="UCXxQTnfwdvMX-Yb30X-WpYQ"
                                                     data-layout="full" data-count="hidden"></div>

                                                <h3>Schedule a vacation</h3>
                                                <p>
                                                    Use the Calendar page from the top navigation to schedule a
                                                    vacation.
                                                    If you can come to an agreement with your family on who uses each
                                                    color, you can easily color code your calendar.
                                                </p>

                                                <h3>Share Photos</h3>
                                                <p>
                                                    Use the Photo Album page to add photos of some of the wonderful
                                                    times you had at your shared vacation home. Whether it is a shared
                                                    beach house or shared ski house or what ever shared vacation home
                                                    you have, you are probably capturing tons of
                                                    great memories on your phone. Upload some of these to the Photo
                                                    Album to share with friends and family.
                                                </p>

                                                <h3>Add Local Guide entries</h3>
                                                <p>
                                                    Did you have an amazing dinner last night at a nearby restaurant? Or
                                                    did you take a fun tour that you highly recommend? Use the Local
                                                    Guide page from the top navigation to add an entry into your Local
                                                    Guide
                                                    where you can share the dinner or tour or whatever to other people
                                                    who enjoy your vacation home.
                                                </p>

                                                <h3>Add to the Guest Book</h3>
                                                <p>
                                                    Ever left a note in the guest book at a bed and breakfast or
                                                    boutique hotel. Today this is done online. Go to the Guest Book page
                                                    in the
                                                    top navigation and leave a note for the owner and add a selfie so
                                                    they can have a history of all the guests that have come and enjoyed
                                                    their vacation home.
                                                </p>

                                                <h3>Share a story in the House Blog</h3>
                                                <p>
                                                    Did something hysterical happen or did you have a great adventure
                                                    one day? Capture the memory for others to share by adding a blog
                                                    entry with pictures and
                                                    details about what happened. This is a fun way to capture some of
                                                    the memories that happen in your vacation home.
                                                </p>

                                                <h3>Learn about and request new features</h3>
                                                <p>
                                                    We primarily share new features on Facebook but also use other
                                                    social media sites. Follow us on our
                                                    <a href="https://www.facebook.com/thevacationcalendar">Facebook</a>
                                                    page to stay up to date and contribute to our growing community of
                                                    users.
                                                    Please use the Contact Us form to suggest new features or request
                                                    help if something is not working the way you expected.
                                                </p>

                                                <div class="fb-like"
                                                     data-href="https://www.facebook.com/thevacationcalendar/"
                                                     data-width="" data-layout="standard" data-action="like"
                                                     data-size="small" data-share="true"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                    <div class="accordion-section mt-80">
                        <div class="container">
                            <div class="m-0 m-lg-4">
                                <div class="accordion" id="myAccordion-4">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSeven">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseSeven">
                                                Understanding the Different Roles
                                            </button>
                                        </h2>
                                        <div id="collapseSeven" class="accordion-collapse collapse show"
                                             data-bs-parent="#myAccordion-4">
                                            <div class="card-body bottom-box-shadow">
                                                <p>TheVacationCalendar.com has three different types of users that can
                                                    access the website.
                                                </p>
                                                <h3>Administrator
                                                </h3>
                                                <p>
                                                    The Administrator is set up during the initial setup of a new
                                                    vacation home on the website. This user is responsible for
                                                    configuring the site to match your vacation home. This user has many
                                                    important functions shown below with some of the most important
                                                    being creating
                                                    additional users and maintaining the House Bulletin Board with
                                                    useful information.
                                                    Administrator with Owner Privileges By checking the "Allow
                                                    Administrator to have Owner permissions" checkbox and clicking the
                                                    Update button on the Administrator's manage account screen, an
                                                    Administrator can have both administrative capabilities and owner
                                                    capabilities.

                                                </p>
                                                <h3>Administrator with Owner Privileges
                                                </h3>
                                                <p>By checking the "Allow Administrator to have Owner permissions"
                                                    checkbox and clicking the Update button on the Administrator's
                                                    manage account screen, an Administrator can have both administrative
                                                    capabilities and owner capabilities.
                                                </p>
                                                <h3>Owner: </h3>
                                                <p>An Owner is set up by the Administrator. As an Owner you can reserve time at the vacation house as long as the time does not overlap with any other scheduled vacations. You have the option to simply block off time when you are using the vacation home or you can go into more detail and specify
                                                    who is going to use each room on any particular date. Owners can contribute to the house in many ways which are outlined below.
                                                </p>
                                                <h3>Guest
                                                </h3>
                                                <p>
                                                    A single Guest account is set up during the initial setup of a new vacation home on the website however the password can be reset easily from the "manage account" screen. This is a generic password that allows users to view the activity on the website but cannot make any changes. You should feel free to send this password out to all of your friends and family who you want to be able to see who is using your vacation home. The Guest is able to click on a vacation and request to join or they can click on a date where the house is not being used to request to use the house.
                                                    This will trigger an email to the appropriate individuals to determine whether to accommodate the request.
                                                </p>

                                                <div class="table-responsive mt-">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 20%" scope="col">Functions</th>
                                                            <th style="width: 20%" scope="col" class="text-center">Administrator</th>
                                                            <th style="width: 20%" scope="col" class="text-center">Administrator / Owner Privileges</th>
                                                            <th style="width: 20%" scope="col" class="text-center">Owner</th>
                                                            <th style="width: 20%" scope="col" class="text-center">Guest</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">Manage subscription</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Create new users </th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Disable existing users </th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Reset other users’ passwords </th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Define rooms in house </th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Create additional properties </th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">View audit history</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">View vacation on calendar</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Create vacations on calendar</th>
                                                            <td></td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Edit vacations you created</th>
                                                            <td></td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Edit vacations anyone created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Delete vacations you created</th>
                                                            <td></td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Delete vacations anyone created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Request to join a vacation</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Request to use vacation home</th>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-center">X</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">View bulletin board</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Edit bulletin board</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">View blog entries</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Like / comment on blog entries</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Create blog entries</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Edit blog entries you created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Edit blog entries anyone created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>



                                                        <tr>
                                                            <th scope="row">Delete blog entries you created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Delete blog entries anyone created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">View photo album</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Create photo albums</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Add photos</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Delete photos you added</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Delete photos anyone added</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">View local guide entries</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Like / comment on local guide entries</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Create local guide entries</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Edit local guide entries you created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Edit local guide entries anyone created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Delete local guide entries you created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">Delete local guide entries anyone created</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">View food item lists</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Edit food item lists</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">View guest book entries</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Add guest book entries</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Approve guest book entries</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="accordion-section mt-80">
                        <div class="container">
                            <div class="m-0 m-lg-4">
                                <div class="accordion" id="myAccordion-3">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive">Different
                                                Ways to Use TheVacationCalendar.com
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse show"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow" >
                                                  ---
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- last section -->

                <!-- ends -->
            </div>
            <!-- nav tabs end -->
        </div>
    </section>
    <!-- End FAQ -->

    @push('scripts')
        <script src="https://apis.google.com/js/platform.js"></script>

        <script async defer crossorigin="anonymous"
                src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0" nonce="ZKRqVdDg"></script>

        <script>
            // var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            //     target: '#list-example'
            // })

            var dataSpyList = [].slice.call(document.querySelectorAll('[data-bs-spy="scroll"]'))
            dataSpyList.forEach(function (dataSpyEl) {
                bootstrap.ScrollSpy.getInstance(dataSpyEl)
                    .refresh()
            })

        </script>
    @endpush

</x-guest-layout>
