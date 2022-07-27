<x-guest-layout>
    <!-- Hero -->
    @include('partials.sub-page-hero-section');
    <!-- End Hero -->

    <!-- FAQ -->
    <div class="container content-space-2 content-space-b-lg-3 bg-crystals">
        <!-- nav tabs -->
        <section class="text-center">
            <div class="help-text shadow-1-strong rounded  d-flex justify-content-center mt-5">
                <h1 class="text-primary font-vintage mb-0">Help</h1>
            </div>
            <h2 class="pt-2 popping-bold">We’d Love to Hear From You</h2>
        </section>
        <div class="help-page-tabs mt-80">
            <ul class="nav nav-tabs  border-bottom-0 d-flex justify-content-center" id="myTab" role="tablist">
                <!-- <div class="row">  -->
                <!-- <div class="col-3">  -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">
                        <div class="card shadow-lg card-border rounded-3">
                            <div class="card-body">
                                <img src="{{asset('/images/help-images/menu-book.png')}}" class="img-fluid m-auto">
                                <p>Quick Start Guide</p>
                            </div>
                        </div>
                        <div class="text-end bg-arrow d-none d-lg-block">
                            <img src="{{asset('/images/help-images/vector-1.png')}}" class="img-fluid">
                        </div>
                    </button>
                </li>
                <!-- </div>  -->
                <!-- <div class="col-3"> -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">
                        <div class="card shadow-lg card-border rounded-3 mt-0 mt-lg-5">
                            <div class="card-body">
                                <img src="{{asset('/images/help-images/instructions.png')}}" class="img-fluid  m-auto">
                                <p>Instructions</p>
                            </div>
                        </div>
                        <div class="text-end bg-arrow d-none d-lg-block">
                            <img src="{{asset('/images/help-images/vector-2.png')}}" class="img-fluid">
                        </div>
                    </button>
                </li>
                <!-- </div>  -->
                <!-- <div class="col-3"> -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">
                        <div class="card shadow-lg card-border rounded-3 mt-lg-n1 ">
                            <div class="card-body">
                                <img src="{{asset('/images/help-images/vacation-calendar.png')}}"
                                     class="img-fluid m-auto">
                                <p><span class="d-none d-lg-block">Different Ways to Use The</span> Vacation Calendar</p>
                            </div>
                        </div>
                        <div class="text-end bg-arrow d-none d-lg-block">
                            <img src="{{asset('/images/help-images/vector-3.png')}}" class="img-fluid">
                        </div>
                    </button>
                </li>
                <!-- </div>  -->
                <!-- <div class="col-3">  -->
                <li class="nav-item " role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">
                        <div class="card shadow-lg card-border rounded-3 mt-0 mt-lg-5">
                            <div class="card-body">
                                <img src="{{asset('/images/help-images/users.png')}}" class="img-fluid  m-auto">
                                <p> <span class="d-none d-lg-block">Understanding the different</span> Users and Roles</p>
                            </div>
                        </div>
                    </button>
                </li>
                <!-- </div>  -->
                <!-- </div> -->
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="accordion-section mt-80">
                    <div class="container">
                        <div class="m-4">
                            <div class="accordion" id="myAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne">Quick Start Guide for Administrators</button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                         data-bs-parent="#myAccordion">
                                        <div class="card-body bottom-box-shadow">
                                            <p>Here are the steps to quickly get your house up and running quickly. For a more thorough understanding of the website please scroll down to see the full Instructions for Administrators or <a href="#">click here.</a>  Please note the <a href="#">Need Help?</a> link at the top right which has a complete instruction guide to TheVacationCalendar.com.</p>
                                            <h3>1 - Set up administrator capabilities</h3>
                                            <p>Use the manage account screen to decide whether you, as an administrator, also want to be able to schedule vacations as an owner. If you do, simply check the "Allow Administrator to have Owner permissions" checkbox and click the update button.</p>
                                            <h3>2 - Create owners</h3>
                                            <p>Use the administer users screen to create usernames and passwords for the people that need to be able to schedule vacations.</p>
                                            <h3>3 - Have fun and tell your friends</h3>
                                            <p>Feel free to share the name of your vacation home and the guest password to as many people as you like. This will give them basic access to see the activity in your vacation home.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mt-3">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseTwo">Quick Start Guide for Owners</button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                         data-bs-parent="#myAccordion">
                                        <div class="card-body bottom-box-shadow">
                                            <p>Here are the steps to quickly get your house up and running quickly. For a more thorough understanding of the website please scroll down to see the full Instructions for Owners or <a href="#">click here </a>. Please note the <a href="#"> Need Help?</a> link at the top right which has a complete instruction guide to TheVacationCalendar.com.</p>
                                            <h3>1 - Schedule a vacation</h3>
                                            <p>Use the vacations screen to schedule a vacation.</p>
                                            <h3>2 - Have fun and tell your friends</h3>
                                            <p>Feel free to share the name of your vacation home and the guest password (ask your house administrator for it) to as many people as you like. This will give them basic access to see the activity in your vacation home.</p>                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="accordion-section mt-80">
                    <div class="container">
                        <div class="m-4">
                            <div class="accordion" id="myAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne">Instructions for Administrators
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                         data-bs-parent="#myAccordion">
                                        <div class="card-body bottom-box-shadow">
                                            <p>As an Administrator on TheVacationCalendar.com website, your responsibility is to set up the house, set up users, and monitor the content.
                                            </p>
                                            <h3>calendar</h3>
                                            <p>Use the calendar to schedule, edit and delete vacations. Simply click on the first date that you are interested in and then specify the end date within the edit box that will appear. Additionally, you will be prompted to add the vacation name.
                                                Lastly, you have the option to select various colors to easily identify your vacations.
                                                To edit your vacation, simply click on any of the calendar days of your vacation and the edit box will appear so you can make any necessary changes.
                                                The calendar screen also allows you to view the vacations that are already scheduled for your vacation home. You can navigate month by month by clicking on the month links at the top of the calendar, or you can jump quickly to a specific month by specifying the date you want to jump to and then clicking the jump button. In addition to viewing vacations scheduled, you have the ability to request to join a vacation. Simply click on a vacation name that is a link and then fill out the information at the bottom of the next page to have TheVacationCalendar.com email the Owner who scheduled the vacation that you would like to join him for all or part of the vacation.</p>
                                            <h3>blog</h3>
                                            <p>The house blog is the location where conversations between all the different users of TheVacationCalendar.com website for your individual vacation home can take place. When you first access the screen the initial blogs are shown. By clicking the "Read Comments" link you can see what comments have been added to that thread. Additionally, you can add a comment to any thread by clicking the "Add Comment Link". Finally, if you want to start a new topic, you can click the "Add a New Blog" at the top of the page. One function that is available to the Administrator that is not available to any other user is the ability to delete blogs. You can use this to keep the blog screen tidy or to remove any inappropriate content.

                                            </p>
                                            <h3>administer users
                                            </h3>
                                            <p>The administer users screen is the most important screen for the house administrator. This is where you create Owners of the house and give them access to the website. You are responsible for setting their initial password which the Owners can change themselves once they have accessed the website. You have the choice of setting up a new Owner with a confirmed account, or you can require that the Owner confirms the account before it can be used. In the latter case, an email is generated and is sent to the Owner's email account. The Owner then needs to open the email and click on the confirmation link which will activate the account.<b> Please note that these confirmation emails almost always end up in junk mail.</b>

                                            </p>
                                            <h3>delete vacations
                                            </h3>
                                            <p>The delete vacations screen is used to delete scheduled vacations. This can be used to resolve any conflicts or allow for changes in the case that someone is abusing the website.
                                            </p>
                                            <h3>manage bulletin board
                                            </h3>
                                            <p>The manage bulletin board screen is another important screen for the administrator. Only the administrator has the ability to add content here which is available to all of the Owners and Guests. This is a great place to include house rules, driving instructions, favorite restaurants, and emergency contact information. Remember to save often.
                                            </p>
                                            <h3>bulletin board
                                            </h3>
                                            <p>This is a simple screen that allows you to view information about the vacation home. If you have any updates or suggestions for this page, please contact your house administrator who has the ability to make changes.                                            </p>
                                            <h3>manage account
                                            </h3>
                                            <p>The manage account screen for the Administrator has several options that are not available to other users. The most important option is whether you would like to have a single account to perform administrative and owner tasks. If you are the house administrator and want to be able to schedule vacations using the same login, select the "Allow Administrator to have Owner permissions" checkbox.

                                                Like other users you can keep you email address and password up to date. In addition you have the ability to unsubscribe from TheVacationCalendar.com website, change the Guest password for your vacation home, and update the picture that shows up in the top right corner of the website.</p>

                                            <h2>Instructions for Guests
                                            </h2>
                                            <p>As an Guest of TheVacationCalendar.com website, you are able to see the vacation schedule of the vacation home. You have the ability to request to join vacations (if permitted by the Owners), to view the bulletin board, and to participate in the house blog. Below are instructions for each of these functions, which are also always available to you using the <a href="#"> Need Help? </a>link at the top of the page.

                                            </p>
                                            <h3>calendar</h3>
                                            <p>The calendar screen allows you to view the vacations that are already scheduled for your vacation home. You can navigate month by month by clicking on the month links at the top of the calendar, or you can jump quickly to a specific month by specifying the date you want to jump to and then clicking the jump button. In addition to viewing vacations scheduled, you have the ability to request to join a vacation. Simply click on a vacation name that is a link and then fill out the information at the bottom of the next page to have TheVacationCalendar.com email the Owner who scheduled the vacation that you would like to join him for all or part of the vacation.

                                            </p>
                                            <h3>blog</h3>
                                            <p>The house blog is the location where conversations between all the different users of TheVacationCalendar.com website for your individual vacation home can take place. When you first access the screen the initial blogs are shown. By clicking the "Read Comments" link you can see what comments have been added to that thread. Additionally, you can add a comment to any thread by clicking the "Add Comment Link". Finally, if you want to start a new topic, you can click the "Add a New Blog" at the top of the page.

                                            </p>
                                            <h3>bulletin board
                                            </h3>
                                            <p>This is a simple screen that allows you to view information about the vacation home. If you have any updates or suggestions for this page, please contact your house administrator who has the ability to make changes.

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mt-3">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseTwo">Instructions for Owners</button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                         data-bs-parent="#myAccordion">
                                        <div class="card-body bottom-box-shadow">

                                            <p>As an Owner on TheVacationCalendar.com website, you main ability is to schedule vacations. You also have the ability to join other vacations (if permitted by other Owners), to view the bulletin board, to participate in the house blog and to manage your profile. Below are instructions for each of these functions, which are also always available to you using the <a href="#">Need Help?</a>  link at the top of the page.

                                            </p>
                                            <h3>calendar</h3>
                                            <p>Use the calendar to schedule, edit and delete vacations. Simply click on the first date that you are interested in and then specify the end date within the edit box that will appear. Additionally, you will be prompted to add the vacation name.

                                                Lastly, you have the option to select various colors to easily identify your vacations.

                                                To edit your vacation, simply click on any of the calendar days of your vacation and the edit box will appear so you can make any necessary changes.

                                                The calendar screen also allows you to view the vacations that are already scheduled for your vacation home. You can navigate month by month by clicking on the month links at the top of the calendar, or you can jump quickly to a specific month by specifying the date you want to jump to and then clicking the jump button. In addition to viewing vacations scheduled, you have the ability to request to join a vacation. Simply click on a vacation name that is a link and then fill out the information at the bottom of the next page to have TheVacationCalendar.com email the Owner who scheduled the vacation that you would like to join him for all or part of the vacation.</p>
                                            <h3>blog</h3>
                                            <p>The house blog is the location where conversations between all the different users of TheVacationCalendar.com website for your individual vacation home can take place. When you first access the screen the initial blogs are shown. By clicking the "Read Comments" link you can see what comments have been added to that thread. Additionally, you can add a comment to any thread by clicking the "Add Comment Link". Finally, if you want to start a new topic, you can click the "Add a New Blog" at the top of the page.
                                            </p>
                                            <h3>bulletin board
                                            </h3>
                                            <p>This is a simple screen that allows you to view information about the vacation home. If you have any updates or suggestions for this page, please contact your house administrator who has the ability to make changes.

                                            </p>
                                            <h3>manage account
                                            </h3>
                                            <p>It is important to note that your email address is used whenever someone requests to join a vacation that you scheduled. You can keep you email address up to date on this page. Additionally, if you need to change you password you can do this here as well.

                                            </p>                     </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
        <!-- nav tabs end -->

    </div>
    <!-- End FAQ -->
</x-guest-layout>
