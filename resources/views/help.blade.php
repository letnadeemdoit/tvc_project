<x-guest-layout>
    <!-- Hero -->
    @include('partials.sub-page-hero-section');
    <!-- End Hero -->

    <!-- FAQ -->
    <div class="container content-space-2 content-space-b-lg-3">
        <!-- nav tabs -->
    <section class="text-center">
        <div class="help-text shadow-1-strong rounded  d-flex justify-content-center mt-5">
            <h1 class="text-primary font-jost">Find Your Vacation House</h1>
        </div>
        <h3 class="pt-2">We’d Love to Hear From You</h3>
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
                                <img src="{{asset('/images/help-images/menu-book.png')}}" class="img-fluid d-none d-md-block m-auto">
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
                                <img src="{{asset('/images/help-images/instructions.png')}}" class="img-fluid d-none d-md-block m-auto">
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
                                     class="img-fluid d-none d-md-block m-auto">
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
                                <img src="{{asset('/images/help-images/users.png')}}" class="img-fluid d-none d-md-block m-auto">
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
                <section class="accordion-section mt-80">
                    <div class="container">
                        <div class="m-4">
                            <div class="accordion" id="myAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne">1. What is
                                            HTML?</button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                         data-bs-parent="#myAccordion">
                                        <div class="card-body bottom-box-shadow">
                                            <p>HTML stands for HyperText Markup Language. HTML is the standard markup
                                                language for describing the structure of web pages. <a
                                                    href="https://www.tutorialrepublic.com/html-tutorial/"
                                                    target="_blank">Learn more.</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mt-3">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseTwo">2. What is Bootstrap?</button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                         data-bs-parent="#myAccordion">
                                        <div class="card-body bottom-box-shadow">
                                            <p>Bootstrap is a sleek, intuitive, and powerful front-end framework for
                                                faster and easier web development. It is a collection of CSS and HTML
                                                conventions. <a
                                                    href="https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/"
                                                    target="_blank">Learn more.</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mt-3">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button type="button" class="accordion-button collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree">3. What is
                                            CSS?</button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                         data-bs-parent="#myAccordion">
                                        <div class="card-body bottom-box-shadow">
                                            <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various
                                                style properties for a given HTML element such as colors, backgrounds,
                                                fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/"
                                                              target="_blank">Learn more.</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
        <!-- nav tabs end -->

    </div>
    <!-- End FAQ -->
</x-guest-layout>
