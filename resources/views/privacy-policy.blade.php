<x-guest-layout>
@push('stylesheets')

@endpush

@include('partials.sub-page-hero-section');

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 text-center text-lg-start ">
                    <!-- Jumbotron -->
                    <div
                        class="text-center shadow-1-strong rounded text-white privacy-policy">
                        <h1 class="h2 text-start text-primary font-jost">Find Your Vacation House</h1>
                    </div>
                    <div class="pt-3">
                        <h3>Privacy Policy</h3>
                        <p class="pe-0 pe-lg-4">
                            This Privacy Policy describes how your personal information is collected, used, and shared when you visit or subscribe to the www.thevacationcalendar.com (the "Site"). Please note that the Site is a hobby that charges a nominal fee to keep the project going since it addresses a niche need and many vacation home owners enjoy it. If you are concerned about privacy and data protection, please do not use the Site. The Site has basic security but should not be used to capture any information that is not publicly available or that the end users are willing to make publicly available. </p>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0 offset-md-1 text-center">
                  <img src="  {{asset('/images/privacy-policy/group-image.png')}}" class="img-fluid" />
                </div>
            </div>
        </div>
    </section>

    <section class="accordion-section">
        <div class="container">
        <div class="m-4">
            <div class="accordion" id="myAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne">1. What is HTML?</button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                        <div class="card-body shadow-lg">
                            <p>HTML stands for HyperText Markup Language. HTML is the standard markup language for describing the structure of web pages. <a href="https://www.tutorialrepublic.com/html-tutorial/" target="_blank">Learn more.</a></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item mt-3">
                    <h2 class="accordion-header" id="headingTwo">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">2. What is Bootstrap?</button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#myAccordion">
                        <div class="card-body shadow-lg">
                            <p>Bootstrap is a sleek, intuitive, and powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item mt-3">
                    <h2 class="accordion-header" id="headingThree">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree">3. What is CSS?</button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                        <div class="card-body shadow-lg">
                            <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

</x-guest-layout>
