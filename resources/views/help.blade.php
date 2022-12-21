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
                                    <div class="accordion-item mb-3">
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

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo">Paypal
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion">
                                            <div class="card-body bottom-box-shadow">

                                                <p>
                                                    TheVacationCalendar.com relies on PayPal’s subscription
                                                    capabilities. Keeping your payment information safe is of the utmost
                                                    importance to us, so we use PayPal as they have best of breed
                                                    security that we could never replicate.</p>

                                                <p>
                                                    Please note that having an up to date payment option in your PayPal
                                                    account does not mean that your monthly/annual payment will be
                                                    successfully processed. PayPal specifies a specific payment method
                                                    to each automatic payment.
                                                </p>
                                                <p>
                                                    It is important to always have a valid
                                                    payment method associated with the TheVacatioCalendar.com automatic
                                                    payment. You can find this screen in PayPal by going to <span
                                                        class="fw-600">
                                                        Settings —>
                                                    Payments —> Automatic Payments
                                                    </span>.

                                                </p>

                                                <img src="{{asset('images/paypal.png')}}" class="img-fluid w-100 mb-4 mt-2" style="object-fit: cover" alt="">

                                                <p>
                                                    PayPal subscriptions will apply the automatic payment at the
                                                    beginning of the payment cycle. So if you are paying for a year of
                                                    service, the payment will be taken up front. Because of this, new
                                                    subscribers have a trial period of 7 days for monthly payment and 20
                                                    days for annual payments so that users can be sure the site meets
                                                    their needs.
                                                </p>
                                                <h3>
                                                    Upgrading
                                                </h3>
                                                <p>
                                                    Upgrades take effect immediately, meaning you will receive the new
                                                    functionality right away. For accounts billed monthly, the new fee
                                                    will be assessed on the next billing cycle. For accounts billed
                                                    annually, a one time charge is assessed for the new functionality
                                                    for the remainder of the payment cycle.
                                                </p>

                                                <div class="table-responsive mb-5">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Current Subscription</th>
                                                            <th class="text-center" scope="col">
                                                                Basic to Standard or
                                                                Standard to Premium

                                                            </th>
                                                            <th class="text-center" scope="col">Price
                                                                Basic to Premium
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">In 1st Month</th>
                                                            <td class="text-center">$20</td>
                                                            <td class="text-center">$40</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 2nd Month</th>
                                                            <td class="text-center">$18</td>
                                                            <td class="text-center">$36</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 3rd Month</th>
                                                            <td class="text-center">$16</td>
                                                            <td class="text-center">$32</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 4th Month</th>
                                                            <td class="text-center">$14</td>
                                                            <td class="text-center">$28</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 5th Month</th>
                                                            <td class="text-center">$12</td>
                                                            <td class="text-center">$24</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 6th Month</th>
                                                            <td class="text-center">$10</td>
                                                            <td class="text-center">$20</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 7th Month</th>
                                                            <td class="text-center">$8</td>
                                                            <td class="text-center">$16</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 8th Month</th>
                                                            <td class="text-center">$6</td>
                                                            <td class="text-center">$12</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 9th Month</th>
                                                            <td class="text-center">$4</td>
                                                            <td class="text-center">$8</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 10th Month</th>
                                                            <td class="text-center">$2</td>
                                                            <td class="text-center">$4</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 11th Month</th>
                                                            <td class="text-center">No charge</td>
                                                            <td class="text-center">$2</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">In 12th Month</th>
                                                            <td class="text-center">No charge</td>
                                                            <td class="text-center">No charge</td>

                                                        </tr>


                                                        </tbody>
                                                    </table>
                                                </div>

                                                <h3>Downgrading & Canceling</h3>
                                                <p>
                                                    PayPal does not support the ability to cancel or downgrade a
                                                    subscription at the end of an active payment cycle. We hope that
                                                    they will add this feature at some point, but for now, if you cancel
                                                    your subscription, the cancellation will immediately take effect.
                                                    Similarly, if you are looking to downgrade your subscription or you
                                                    want to switch from paying annually to monthly, the change will take
                                                    effect immediately and you will lose the remainder of your pre-paid
                                                    subscription. If your intention is to use the site through the end
                                                    of your current payment cycle, simply add a reminder to your
                                                    calendar to cancel the subscription closer to the end of your
                                                    payment cycle. Similarly, if you intend to switch from annually to
                                                    monthly, please wait until just before your subscription renews to
                                                    make the change.
                                                </p>

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
                                                <p>An Owner is set up by the Administrator. As an Owner you can reserve
                                                    time at the vacation house as long as the time does not overlap with
                                                    any other scheduled vacations. You have the option to simply block
                                                    off time when you are using the vacation home or you can go into
                                                    more detail and specify
                                                    who is going to use each room on any particular date. Owners can
                                                    contribute to the house in many ways which are outlined below.
                                                </p>
                                                <h3>Guest
                                                </h3>
                                                <p>
                                                    A single Guest account is set up during the initial setup of a new
                                                    vacation home on the website however the password can be reset
                                                    easily from the "manage account" screen. This is a generic password
                                                    that allows users to view the activity on the website but cannot
                                                    make any changes. You should feel free to send this password out to
                                                    all of your friends and family who you want to be able to see who is
                                                    using your vacation home. The Guest is able to click on a vacation
                                                    and request to join or they can click on a date where the house is
                                                    not being used to request to use the house.
                                                    This will trigger an email to the appropriate individuals to
                                                    determine whether to accommodate the request.
                                                </p>

                                                <div class="table-responsive mt-">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 20%" scope="col">Functions</th>
                                                            <th style="width: 20%" scope="col" class="text-center">
                                                                Administrator
                                                            </th>
                                                            <th style="width: 20%" scope="col" class="text-center">
                                                                Administrator / Owner Privileges
                                                            </th>
                                                            <th style="width: 20%" scope="col" class="text-center">
                                                                Owner
                                                            </th>
                                                            <th style="width: 20%" scope="col" class="text-center">
                                                                Guest
                                                            </th>
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
                                                            <th scope="row">Create new users</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Disable existing users</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Reset other users’ passwords</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Define rooms in house</th>
                                                            <td class="text-center">X</td>
                                                            <td class="text-center">X</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Create additional properties</th>
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
                                                            <th scope="row">Delete local guide entries anyone created
                                                            </th>
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
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#calendar">Calendar
                                            </button>
                                        </h2>
                                        <div id="calendar" class="accordion-collapse collapse show"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">

                                                <div id="collapseone" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Calendar</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">The Calendar screen
                                                            allows you to view the vacations that are already scheduled
                                                            for your vacation home.
                                                            You can navigate month by month by clicking on the right and
                                                            left arrows at the top of the calendar.</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/calendar.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">If someone else has
                                                            already scheduled a vacation when you would like to use the
                                                            vacation home, any user has the ability to “Request to Join”
                                                            a vacation. Simply click
                                                            on a vacation name that is a link and then fill out the
                                                            information at the bottom of the next page to have
                                                            TheVacationCalendar.com email the Owner who scheduled that
                                                            vacation.

                                                            To use the calendar to schedule a vacation, simply click on
                                                            the first date that you are interested in and then specify
                                                            the end date within the edit box that will appear.
                                                            To edit or delete your vacation, simply click on any of the
                                                            calendar days of your vacation and the edit box will appear
                                                            so you can make any necessary changes. Don’t forget, Owners
                                                            can only edit and delete the vacations they schedule.
                                                            Administrators can edit and delete any and all vacations.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/calendar2.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Every calendar entry
                                                            needs a name that will be visible to all users. You also
                                                            have the option to select various colors to easily identify
                                                            your vacations.
                                                            A new feature that has been added allows vacations to repeat
                                                            on a monthly or annual basis. If you choose this option, you
                                                            can specify how many times you want this vacation to repeat.
                                                            Finally,
                                                            if you have upgraded your home to the second tier, you have
                                                            the ability to specify which rooms are occupied during your
                                                            vacation.
                                                            This makes it easier for friends and family to see if there
                                                            is room to join you before they “Request to Join” your
                                                            vacation.

                                                            As an Administrator, you have even more control over the
                                                            calendar. You have access to an administrative view where
                                                            you can see all the vacation in a list where you can easily
                                                            edit or delete them.

                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/calendar3.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">If you feel this
                                                            additional view is not necessary, you can remove it from the
                                                            left
                                                            navigation by turning off the toggle in the Preferences
                                                            section of the Account Information page.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/calendar4.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                </div>

{{--                                                <div id="photo-album" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Photo Album</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">The photo album is one--}}
{{--                                                            of the most popular features (outside of the calendar) on--}}
{{--                                                            the site.--}}
{{--                                                            The newest version not only allows you to add photos, but--}}
{{--                                                            you can add photo albums and even put albums inside other--}}
{{--                                                            albums.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/album1.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">It is recommended to--}}
{{--                                                            start by creating a few albums in the Admin section of the--}}
{{--                                                            site. Here you can see all your albums.--}}
{{--                                                            If an album is nested under another album, you will notice--}}
{{--                                                            that the parent album column is populated with the parent--}}
{{--                                                            album that the specific album resides within.--}}
{{--                                                            You can edit and delete albums from this view, but please--}}
{{--                                                            note the album has to be empty before you can delete it.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/album2.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">To create an album,--}}
{{--                                                            simply click the Add New Album button. Here you can add an--}}
{{--                                                            image (called a thumbnail) for the folder,--}}
{{--                                                            you can select a parent album if you want this album nested,--}}
{{--                                                            and you can label and give the album a description. A couple--}}
{{--                                                            of important notes.--}}
{{--                                                            If you don’t upload an image, the album will choose the--}}
{{--                                                            first photo in the album as the thumbnail. Additionally, if--}}
{{--                                                            you don’t select--}}
{{--                                                            anything from the Select Parent Album, the album will be a--}}
{{--                                                            top level album. This is not 100% intuitive and tripped me--}}
{{--                                                            up the first time.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/album3.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">To go inside the--}}
{{--                                                            album, click the Photos button for the album you want to--}}
{{--                                                            see.--}}
{{--                                                            Here you can add photos by clicking the Add New Photos and--}}
{{--                                                            you can edit or--}}
{{--                                                            delete existing photos by putting you mouse over the photo--}}
{{--                                                            and clicking either the Edit button to edit or the trash can--}}
{{--                                                            button to delete.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/album4.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">When adding a photo--}}
{{--                                                            for the first time it is important to note that there are--}}
{{--                                                            two saves.--}}
{{--                                                            Once you either drag and drop or select the photo you want,--}}
{{--                                                            you have the opportunity to rotate the photo, crop the--}}
{{--                                                            photo, remove the photo, etc.--}}
{{--                                                            When you are done editing, you will need to press the small--}}
{{--                                                            Save button and upload the photo with these adjustments.--}}
{{--                                                            Once you have uploaded your photo you have the option to add--}}
{{--                                                            a description.--}}
{{--                                                            When you are all set you press the Save Photo button at the--}}
{{--                                                            bottom and the photo is added to your album.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/album5.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Your photo album is--}}
{{--                                                            available in the Guest View by clicking Photo Album (circled--}}
{{--                                                            in red) in the top navigation bar.--}}
{{--                                                            Here you can see all the albums and you can click on the--}}
{{--                                                            album to see the photos or other albums within the album.--}}
{{--                                                            You can use the breadcrumbs (circled in green) to go up one--}}
{{--                                                            more levels in the albums. All users have the ability to add--}}
{{--                                                            photos to--}}
{{--                                                            existing albums by clicking the Add New Photo (circled in--}}
{{--                                                            blue). It is important to note that the Administrator is the--}}
{{--                                                            only user that can create albums--}}
{{--                                                            which is why it is helpful to set them up ahead of time for--}}
{{--                                                            your users. This will also help to keep your photos well--}}
{{--                                                            organized.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/album6.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Over the years we have--}}
{{--                                                            heard from users using the site for lake house calendar,--}}
{{--                                                            beach house calendar,--}}
{{--                                                            mountain house calendar, cabin calendar, condo calendar, ski--}}
{{--                                                            house calendar, river house calendar and even an RV--}}
{{--                                                            calendar.--}}
{{--                                                            Given the wide use of TheVacationCalendar.com,--}}
{{--                                                            we felt a modern photo album was exactly what the site--}}
{{--                                                            needed to help capture memories from so many great vacation--}}
{{--                                                            homes.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}

{{--                                                <div id="blog" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Blog</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">The blog is where your--}}
{{--                                                            users can go to share stories about the time at your--}}
{{--                                                            vacation home.--}}
{{--                                                            Blogs can be organized into categories so that if you have--}}
{{--                                                            very loquacious users,--}}
{{--                                                            the blog won’t get overwhelming. The blog is ordered by--}}
{{--                                                            descending date so the most recent blog will be at the top.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/blog1.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Again, as the--}}
{{--                                                            Administrator, it is helpful to start in the Admin section--}}
{{--                                                            of the site to set up the Categories for the blog.--}}
{{--                                                            You can add a new Category from the Blog screens in the--}}
{{--                                                            Admin section, going directly to the Categories in the Admin--}}
{{--                                                            → Settings page or even access Categories when adding a new--}}
{{--                                                            Blog entry.--}}

{{--                                                            Please note that in the Categories page of the settings, you--}}
{{--                                                            can add Categories for a variety of screens. Make sure to--}}
{{--                                                            select Blog in the Select Type dropdown to add a new Blog--}}
{{--                                                            category.--}}

{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/blog2.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">From the Admin--}}
{{--                                                            section, the Administrator can edit and delete blog entries.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/blog3.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">When adding or--}}
{{--                                                            updating a Blog, you have the ability to add a photo which--}}
{{--                                                            will be displayed prominently as well as a title (subject)--}}
{{--                                                            and content.--}}
{{--                                                            In the add and update screen you can select the category of--}}
{{--                                                            the Blog.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/blog4.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">In the Guest View of--}}
{{--                                                            the blog pages. Users can filter blog entries by category--}}
{{--                                                            and then click on a blog--}}
{{--                                                            to see all the content. Users have the option to like the--}}
{{--                                                            blog entry as well as add comments.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top" src="/images/images-home/blog5.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="bulletin-board" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">House Bulletin Board</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">The House Bulletin--}}
{{--                                                            Board is one part of the site that is completely controlled--}}
{{--                                                            by the Administrator.--}}
{{--                                                            It is important to note that the bulletin board is set up in--}}
{{--                                                            what is known as a “card layout”. The reason for this is--}}
{{--                                                            that a single big page--}}
{{--                                                            of text does not work for mobile phones. As a result,--}}
{{--                                                            to create an effective bulletin board for your house, you--}}
{{--                                                            will need to break the content you want to convey into--}}
{{--                                                            individual entries.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/bulletin1.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">The House Bulletin--}}
{{--                                                            Board is set up in the Admin section of the site.--}}
{{--                                                            Similar to other features, the Administrator can set up--}}
{{--                                                            categories to organize the bulletin board posts.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/bulletin2.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Please note that in--}}
{{--                                                            the Categories page of the settings, you can add--}}
{{--                                                            Categories for a variety of screens. Make sure to select--}}
{{--                                                            Bulletins in the Select Type dropdown to add a new Bulletin--}}
{{--                                                            Board category.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/bulletin3.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">When adding or--}}
{{--                                                            updating a Blog, you have the ability to add a photo which--}}
{{--                                                            will be displayed at the top--}}
{{--                                                            of the entry and you will be able to add a title and the--}}
{{--                                                            bulletin board content. In the add and update screen you can--}}
{{--                                                            select the category.--}}
{{--                                                            Please note that by clicking the ellipse (3 dots) you will--}}
{{--                                                            find additional formatting options for your information.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/bulletin4.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="local-guide" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Local Guide</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">The local guide works--}}
{{--                                                            similarly to blog posts, but they are designed--}}
{{--                                                            to be more permanent so you can create your own guide book--}}
{{--                                                            of things to do, places to eat, and other helpful--}}
{{--                                                            recommendations.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/local-guide1.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">The Administrator--}}
{{--                                                            should start in the Admin section of the site--}}
{{--                                                            to set up the Categories for the Local Guide. You can add a--}}
{{--                                                            new Category from the Local Guide screens in the Admin--}}
{{--                                                            section,--}}
{{--                                                            going directly to the Categories in the Admin → Settings--}}
{{--                                                            page or even access Categories when adding a new Local Guide--}}
{{--                                                            entry.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/local-guide2.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Please note that in--}}
{{--                                                            the Categories page of the settings,--}}
{{--                                                            you can add Categories for a variety of screens.--}}
{{--                                                            Make sure to select LocalGuide in the Select Type dropdown--}}
{{--                                                            to add a new Local Guide category.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/local-guide3.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">When adding or--}}
{{--                                                            updating a Local Guide entry, you have the ability to add a--}}
{{--                                                            photo which will be displayed prominently. The Local Guide--}}
{{--                                                            leverages Google Maps for the address so that you can--}}
{{--                                                            type in an address and Google Maps will help you find the--}}
{{--                                                            exact location. This allows users to--}}
{{--                                                            click on the View to see the location on a map and easily--}}
{{--                                                            get driving directions.--}}

{{--                                                            After entering the category, title, address, hours when the--}}
{{--                                                            item is open or available, the user has the ability--}}
{{--                                                            to put in a detailed overview of the entry which can be--}}
{{--                                                            formatted, include images, etc.--}}

{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/local-guide4.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Users can access the--}}
{{--                                                            local guides from the top navigation and by clicking on the--}}
{{--                                                            image of the entry, can see the additional details that were--}}
{{--                                                            provided. All your users can--}}
{{--                                                            add ratings and comments to the local guide entries so that--}}
{{--                                                            other guests can see what really is popular and highly--}}
{{--                                                            rated.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/local-guide5.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="guest-book" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Guest Book</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Users can leave a--}}
{{--                                                            review or thank you in the Guest Book section of the site.--}}
{{--                                                            This should be very straightforward for users to do.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/guest-book1.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">The only item of note--}}
{{--                                                            is that the posts are not put on the site until--}}
{{--                                                            the Administrator approves them. The Administrator can see--}}
{{--                                                            all the posts in the Admin section of the site.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/guest-book2.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Since the Guest--}}
{{--                                                            password is a shared password, it is not possible to know--}}
{{--                                                            who--}}
{{--                                                            is actually posting comments. Just in case someone has less--}}
{{--                                                            than the best intentions,--}}
{{--                                                            the Administrator has the opportunity to review a post and--}}
{{--                                                            then make it active if it is approved.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/guest-book3.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Whether you are using--}}
{{--                                                            the site for lake house calendar, beach house calendar,--}}
{{--                                                            condo calendar, ski house calendar, mountain house calendar,--}}
{{--                                                            river house calendar, cabin calendar and even an RV--}}
{{--                                                            calendar.--}}
{{--                                                            We hope this feature will help you memorialize all the--}}
{{--                                                            wonderful guests that have enjoyed your vacation home!--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="food-items" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Food Items</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Another very--}}
{{--                                                            straightforward feature are the two Food Items pages.--}}
{{--                                                            These pages are designed to help families keep track of the--}}
{{--                                                            food that is in the house and what--}}
{{--                                                            needs to be picked up at the store. This is an important--}}
{{--                                                            feature for my family as we get the privilege--}}
{{--                                                            to stay at an amazing home in the Caribbean from time to--}}
{{--                                                            time. Unfortunately, groceries are crazy expensive--}}
{{--                                                            and many items are hard to find so it is nice to bring a few--}}
{{--                                                            things down when we come. Now everyone knows--}}
{{--                                                            what is at the house and what pantry items need to be picked--}}
{{--                                                            up.--}}

{{--                                                            The lists can be found under Food Items on the top--}}
{{--                                                            navigation bar. Users can switch between the two lists by--}}
{{--                                                            using the toggle on the top right.--}}

{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/food-item1.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">--}}
{{--                                                            In the Admin section of the site, users can add and delete--}}
{{--                                                            food items for the two lists.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/food-item2.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">--}}
{{--                                                            When adding new items, users have the option to add a photo--}}
{{--                                                            in case there is a particular brand or type of food needed.--}}
{{--                                                            The food items in the house have a field for the--}}
{{--                                                            expiration date and the location in the house while the--}}
{{--                                                            shopping list items have a field for where to buy the item.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/food-item3.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="booking-rooms" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Booking Rooms</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Coming Soon!--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    --}}{{--                                                    <div class="mb-3">--}}
{{--                                                    --}}{{--                                                        <img class="card-img-top" src="/images/images-home/food-item1.png"--}}
{{--                                                    --}}{{--                                                             alt="Card image cap"/>--}}
{{--                                                    --}}{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="additional-properties" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Additional Properties</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Don’t want to have--}}
{{--                                                            multiple logins for your lake house calendar, ski house--}}
{{--                                                            calendar and beach house--}}
{{--                                                            calendar? Setting up additional homes is extremely easy. As--}}
{{--                                                            long as you have upgraded to our Premium plan, you are able--}}
{{--                                                            to add up to 9--}}
{{--                                                            additional houses. This is helpful if you have several--}}
{{--                                                            cottages or cabins, or just happen to be lucky enough to--}}
{{--                                                            have a bunch of vacation homes.--}}

{{--                                                            To add another house, simply go to the Admin section, expand--}}
{{--                                                            the settings, and click the Add New House button. Fill out--}}
{{--                                                            the additional--}}
{{--                                                            information and you are good to go.--}}

{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/additional-properties1.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">To change houses, from--}}
{{--                                                            anywhere in the Admin section of the site, you can click the--}}
{{--                                                            Properties--}}
{{--                                                            dropdown at the top right of the screen. You can select--}}
{{--                                                            whichever house you want.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/additional-properties2.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">A second home is--}}
{{--                                                            completely independent of the original. It will have its own--}}
{{--                                                            bulletin board,--}}
{{--                                                            photo album, blog, etc. The only items that it shares are--}}
{{--                                                            the users. If you are an owner of one house, you are--}}
{{--                                                            automatically an owner--}}
{{--                                                            of the second home. This allows your users to not have to--}}
{{--                                                            maintain multiple usernames and passwords.--}}

{{--                                                            Additionally, the main benefit of having multiple houses on--}}
{{--                                                            one account is the calendar allows users to select one or--}}
{{--                                                            more properties.--}}
{{--                                                            This allows users to see if there is availability across--}}
{{--                                                            multiple houses at one time.--}}

{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="managing-users" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Managing Users</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">A key responsibility--}}
{{--                                                            for the Administrator is to create additional users for the--}}
{{--                                                            site. Every user who--}}
{{--                                                            can schedule vacations needs their own username and password--}}
{{--                                                            so that only that person can edit or delete the scheduled--}}
{{--                                                            vacation.--}}
{{--                                                            The users page is located in the Admin section of the site--}}
{{--                                                            and can be found by expanding the Settings in the left hand--}}
{{--                                                            navigation.--}}

{{--                                                            To add a new user, simply press the Add New User button,--}}
{{--                                                            select which house the user can access and then populate--}}
{{--                                                            information including--}}
{{--                                                            username, email, first name and last name. You have the--}}
{{--                                                            option of having the site send an email with this--}}
{{--                                                            information. Users are created--}}
{{--                                                            but are not immediately enabled, so make sure to click the--}}
{{--                                                            enabled checkbox.--}}

{{--                                                            If you ever want to remove a user, it is recommended to just--}}
{{--                                                            unclick the enabled checkbox versus deleting the user--}}
{{--                                                            altogether. If a user is--}}
{{--                                                            deleted, all of the vacations, blogs, etc. that the user--}}
{{--                                                            created will only be editable by the Administrator. You--}}
{{--                                                            cannot recreate a user with--}}
{{--                                                            the same username and be able to update content created by--}}
{{--                                                            the original user.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/manage-user.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div id="audit-history" class="mb-5">--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Audit History & Notifications</h3>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">Two similar pieces of--}}
{{--                                                            functionality allow Administrators to see exactly--}}
{{--                                                            what users are doing on the site. This is helpful if you--}}
{{--                                                            have a user--}}
{{--                                                            that SWEARS they created a vacation for the first week in--}}
{{--                                                            August. You can search for the user and see exactly what--}}
{{--                                                            he/she did.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/audit-history1.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <p class="card-text text-light-secondary">A less technical--}}
{{--                                                            version of this can be found by clicking the icon on the--}}
{{--                                                            page.--}}
{{--                                                            Currently all blog and vacation changes appear here, but--}}
{{--                                                            over time changes in other parts of the site will appear--}}
{{--                                                            here as well.--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <img class="card-img-top"--}}
{{--                                                             src="/images/images-home/audit-history2.png"--}}
{{--                                                             alt="Card image cap"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingSix">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#photo-album">Photo Album
                                            </button>
                                        </h2>
                                        <div id="photo-album" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapsetwo" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Photo Album</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">The photo album is one
                                                            of the most popular features (outside of the calendar) on
                                                            the site.
                                                            The newest version not only allows you to add photos, but
                                                            you can add photo albums and even put albums inside other
                                                            albums.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/album1.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">It is recommended to
                                                            start by creating a few albums in the Admin section of the
                                                            site. Here you can see all your albums.
                                                            If an album is nested under another album, you will notice
                                                            that the parent album column is populated with the parent
                                                            album that the specific album resides within.
                                                            You can edit and delete albums from this view, but please
                                                            note the album has to be empty before you can delete it.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/album2.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">To create an album,
                                                            simply click the Add New Album button. Here you can add an
                                                            image (called a thumbnail) for the folder,
                                                            you can select a parent album if you want this album nested,
                                                            and you can label and give the album a description. A couple
                                                            of important notes.
                                                            If you don’t upload an image, the album will choose the
                                                            first photo in the album as the thumbnail. Additionally, if
                                                            you don’t select
                                                            anything from the Select Parent Album, the album will be a
                                                            top level album. This is not 100% intuitive and tripped me
                                                            up the first time.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/album3.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">To go inside the
                                                            album, click the Photos button for the album you want to
                                                            see.
                                                            Here you can add photos by clicking the Add New Photos and
                                                            you can edit or
                                                            delete existing photos by putting you mouse over the photo
                                                            and clicking either the Edit button to edit or the trash can
                                                            button to delete.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/album4.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">When adding a photo
                                                            for the first time it is important to note that there are
                                                            two saves.
                                                            Once you either drag and drop or select the photo you want,
                                                            you have the opportunity to rotate the photo, crop the
                                                            photo, remove the photo, etc.
                                                            When you are done editing, you will need to press the small
                                                            Save button and upload the photo with these adjustments.
                                                            Once you have uploaded your photo you have the option to add
                                                            a description.
                                                            When you are all set you press the Save Photo button at the
                                                            bottom and the photo is added to your album.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/album5.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Your photo album is
                                                            available in the Guest View by clicking Photo Album (circled
                                                            in red) in the top navigation bar.
                                                            Here you can see all the albums and you can click on the
                                                            album to see the photos or other albums within the album.
                                                            You can use the breadcrumbs (circled in green) to go up one
                                                            more levels in the albums. All users have the ability to add
                                                            photos to
                                                            existing albums by clicking the Add New Photo (circled in
                                                            blue). It is important to note that the Administrator is the
                                                            only user that can create albums
                                                            which is why it is helpful to set them up ahead of time for
                                                            your users. This will also help to keep your photos well
                                                            organized.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/album6.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Over the years we have
                                                            heard from users using the site for lake house calendar,
                                                            beach house calendar,
                                                            mountain house calendar, cabin calendar, condo calendar, ski
                                                            house calendar, river house calendar and even an RV
                                                            calendar.
                                                            Given the wide use of TheVacationCalendar.com,
                                                            we felt a modern photo album was exactly what the site
                                                            needed to help capture memories from so many great vacation
                                                            homes.
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingSeven">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#blog">Blog
                                            </button>
                                        </h2>
                                        <div id="blog" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapsethree" class="mb-5">
                                                    {{--                                            <div class="mb-3">--}}
                                                    {{--                                                <h3 class="card-title">Blog</h3>--}}
                                                    {{--                                            </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">The blog is where your
                                                            users can go to share stories about the time at your
                                                            vacation home.
                                                            Blogs can be organized into categories so that if you have
                                                            very loquacious users,
                                                            the blog won’t get overwhelming. The blog is ordered by
                                                            descending date so the most recent blog will be at the top.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/blog1.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Again, as the
                                                            Administrator, it is helpful to start in the Admin section
                                                            of the site to set up the Categories for the blog.
                                                            You can add a new Category from the Blog screens in the
                                                            Admin section, going directly to the Categories in the Admin
                                                            → Settings page or even access Categories when adding a new
                                                            Blog entry.

                                                            Please note that in the Categories page of the settings, you
                                                            can add Categories for a variety of screens. Make sure to
                                                            select Blog in the Select Type dropdown to add a new Blog
                                                            category.

                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/blog2.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">From the Admin
                                                            section, the Administrator can edit and delete blog entries.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/blog3.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">When adding or
                                                            updating a Blog, you have the ability to add a photo which
                                                            will be displayed prominently as well as a title (subject)
                                                            and content.
                                                            In the add and update screen you can select the category of
                                                            the Blog.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/blog4.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">In the Guest View of
                                                            the blog pages. Users can filter blog entries by category
                                                            and then click on a blog
                                                            to see all the content. Users have the option to like the
                                                            blog entry as well as add comments.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top" src="/images/images-home/blog5.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingEight">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#bulletin-board">House Bulletin Board
                                            </button>
                                        </h2>
                                        <div id="bulletin-board" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapsefour" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">House Bulletin Board</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">The House Bulletin
                                                            Board is one part of the site that is completely controlled
                                                            by the Administrator.
                                                            It is important to note that the bulletin board is set up in
                                                            what is known as a “card layout”. The reason for this is
                                                            that a single big page
                                                            of text does not work for mobile phones. As a result,
                                                            to create an effective bulletin board for your house, you
                                                            will need to break the content you want to convey into
                                                            individual entries.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/bulletin1.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">The House Bulletin
                                                            Board is set up in the Admin section of the site.
                                                            Similar to other features, the Administrator can set up
                                                            categories to organize the bulletin board posts.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/bulletin2.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Please note that in
                                                            the Categories page of the settings, you can add
                                                            Categories for a variety of screens. Make sure to select
                                                            Bulletins in the Select Type dropdown to add a new Bulletin
                                                            Board category.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/bulletin3.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">When adding or
                                                            updating a Blog, you have the ability to add a photo which
                                                            will be displayed at the top
                                                            of the entry and you will be able to add a title and the
                                                            bulletin board content. In the add and update screen you can
                                                            select the category.
                                                            Please note that by clicking the ellipse (3 dots) you will
                                                            find additional formatting options for your information.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/bulletin4.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingNine">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#local-guide">Local Guide
                                            </button>
                                        </h2>
                                        <div id="local-guide" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapsefive" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Local Guide</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">The local guide works
                                                            similarly to blog posts, but they are designed
                                                            to be more permanent so you can create your own guide book
                                                            of things to do, places to eat, and other helpful
                                                            recommendations.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/local-guide1.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">The Administrator
                                                            should start in the Admin section of the site
                                                            to set up the Categories for the Local Guide. You can add a
                                                            new Category from the Local Guide screens in the Admin
                                                            section,
                                                            going directly to the Categories in the Admin → Settings
                                                            page or even access Categories when adding a new Local Guide
                                                            entry.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/local-guide2.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Please note that in
                                                            the Categories page of the settings,
                                                            you can add Categories for a variety of screens.
                                                            Make sure to select LocalGuide in the Select Type dropdown
                                                            to add a new Local Guide category.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/local-guide3.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">When adding or
                                                            updating a Local Guide entry, you have the ability to add a
                                                            photo which will be displayed prominently. The Local Guide
                                                            leverages Google Maps for the address so that you can
                                                            type in an address and Google Maps will help you find the
                                                            exact location. This allows users to
                                                            click on the View to see the location on a map and easily
                                                            get driving directions.

                                                            After entering the category, title, address, hours when the
                                                            item is open or available, the user has the ability
                                                            to put in a detailed overview of the entry which can be
                                                            formatted, include images, etc.

                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/local-guide4.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Users can access the
                                                            local guides from the top navigation and by clicking on the
                                                            image of the entry, can see the additional details that were
                                                            provided. All your users can
                                                            add ratings and comments to the local guide entries so that
                                                            other guests can see what really is popular and highly
                                                            rated.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/local-guide5.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingTen">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#guest-book">Guest Book
                                            </button>
                                        </h2>
                                        <div id="guest-book" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapseSix" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Guest Book</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Users can leave a
                                                            review or thank you in the Guest Book section of the site.
                                                            This should be very straightforward for users to do.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/guest-book1.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">The only item of note
                                                            is that the posts are not put on the site until
                                                            the Administrator approves them. The Administrator can see
                                                            all the posts in the Admin section of the site.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/guest-book2.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Since the Guest
                                                            password is a shared password, it is not possible to know
                                                            who
                                                            is actually posting comments. Just in case someone has less
                                                            than the best intentions,
                                                            the Administrator has the opportunity to review a post and
                                                            then make it active if it is approved.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/guest-book3.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Whether you are using
                                                            the site for lake house calendar, beach house calendar,
                                                            condo calendar, ski house calendar, mountain house calendar,
                                                            river house calendar, cabin calendar and even an RV
                                                            calendar.
                                                            We hope this feature will help you memorialize all the
                                                            wonderful guests that have enjoyed your vacation home!
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingEleven">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#food-items">Food Items
                                            </button>
                                        </h2>
                                        <div id="food-items" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapseSeven" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Food Items</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Another very
                                                            straightforward feature are the two Food Items pages.
                                                            These pages are designed to help families keep track of the
                                                            food that is in the house and what
                                                            needs to be picked up at the store. This is an important
                                                            feature for my family as we get the privilege
                                                            to stay at an amazing home in the Caribbean from time to
                                                            time. Unfortunately, groceries are crazy expensive
                                                            and many items are hard to find so it is nice to bring a few
                                                            things down when we come. Now everyone knows
                                                            what is at the house and what pantry items need to be picked
                                                            up.

                                                            The lists can be found under Food Items on the top
                                                            navigation bar. Users can switch between the two lists by
                                                            using the toggle on the top right.

                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/food-item1.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">
                                                            In the Admin section of the site, users can add and delete
                                                            food items for the two lists.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/food-item2.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">
                                                            When adding new items, users have the option to add a photo
                                                            in case there is a particular brand or type of food needed.
                                                            The food items in the house have a field for the
                                                            expiration date and the location in the house while the
                                                            shopping list items have a field for where to buy the item.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/food-item3.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingTwelve">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#booking-rooms">Booking Rooms
                                            </button>
                                        </h2>
                                        <div id="booking-rooms" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapseEight" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Food Items</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">
                                                            Comming Soon.!
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingThirteen">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#additional-properties">Additional Properties
                                            </button>
                                        </h2>
                                        <div id="additional-properties" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapseTen" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Additional Properties</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Don’t want to have
                                                            multiple logins for your lake house calendar, ski house
                                                            calendar and beach house
                                                            calendar? Setting up additional homes is extremely easy. As
                                                            long as you have upgraded to our Premium plan, you are able
                                                            to add up to 9
                                                            additional houses. This is helpful if you have several
                                                            cottages or cabins, or just happen to be lucky enough to
                                                            have a bunch of vacation homes.

                                                            To add another house, simply go to the Admin section, expand
                                                            the settings, and click the Add New House button. Fill out
                                                            the additional
                                                            information and you are good to go.

                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/additional-properties1.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">To change houses, from
                                                            anywhere in the Admin section of the site, you can click the
                                                            Properties
                                                            dropdown at the top right of the screen. You can select
                                                            whichever house you want.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/additional-properties2.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">A second home is
                                                            completely independent of the original. It will have its own
                                                            bulletin board,
                                                            photo album, blog, etc. The only items that it shares are
                                                            the users. If you are an owner of one house, you are
                                                            automatically an owner
                                                            of the second home. This allows your users to not have to
                                                            maintain multiple usernames and passwords.

                                                            Additionally, the main benefit of having multiple houses on
                                                            one account is the calendar allows users to select one or
                                                            more properties.
                                                            This allows users to see if there is availability across
                                                            multiple houses at one time.

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingForteen">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#managing-users">Managing Users
                                            </button>
                                        </h2>
                                        <div id="managing-users" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapseEleven" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Managing Users</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">A key responsibility
                                                            for the Administrator is to create additional users for the
                                                            site. Every user who
                                                            can schedule vacations needs their own username and password
                                                            so that only that person can edit or delete the scheduled
                                                            vacation.
                                                            The users page is located in the Admin section of the site
                                                            and can be found by expanding the Settings in the left hand
                                                            navigation.

                                                            To add a new user, simply press the Add New User button,
                                                            select which house the user can access and then populate
                                                            information including
                                                            username, email, first name and last name. You have the
                                                            option of having the site send an email with this
                                                            information. Users are created
                                                            but are not immediately enabled, so make sure to click the
                                                            enabled checkbox.

                                                            If you ever want to remove a user, it is recommended to just
                                                            unclick the enabled checkbox versus deleting the user
                                                            altogether. If a user is
                                                            deleted, all of the vacations, blogs, etc. that the user
                                                            created will only be editable by the Administrator. You
                                                            cannot recreate a user with
                                                            the same username and be able to update content created by
                                                            the original user.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/manage-user.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="headingFifteen">
                                            <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse" data-bs-target="#notifications">Audit History & Notifications
                                            </button>
                                        </h2>
                                        <div id="notifications" class="accordion-collapse collapse"
                                             data-bs-parent="#myAccordion-3">
                                            <div class="card-body bottom-box-shadow">
                                                <div id="collapseTwelve" class="mb-5">
{{--                                                    <div class="mb-3">--}}
{{--                                                        <h3 class="card-title">Audit History & Notifications</h3>--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">Two similar pieces of
                                                            functionality allow Administrators to see exactly
                                                            what users are doing on the site. This is helpful if you
                                                            have a user
                                                            that SWEARS they created a vacation for the first week in
                                                            August. You can search for the user and see exactly what
                                                            he/she did.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/audit-history1.png"
                                                             alt="Card image cap"/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="card-text text-light-secondary">A less technical
                                                            version of this can be found by clicking the icon on the
                                                            page.
                                                            Currently all blog and vacation changes appear here, but
                                                            over time changes in other parts of the site will appear
                                                            here as well.
                                                        </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <img class="card-img-top"
                                                             src="/images/images-home/audit-history2.png"
                                                             alt="Card image cap"/>
                                                    </div>
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
