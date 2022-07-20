<x-guest-layout>
    @push('stylesheets')

    @endpush

    @include('partials.sub-page-hero-section');

    <section class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="contact-text shadow-1-strong rounded  d-flex justify-content-center mt-5">
                        <h1 class="text-primary font-jost">Find Your Vacation House</h1>
                    </div>
                    <h3 class="pt-2">We’d Love to Hear From You</h3>
                    <p class="pt-2">Thank you very much for visiting TheVacationCalendar.com. If you have any questions
                        about the service, technical issues, or any other suggestions, please feel free to email.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <div class="contact-page">
        <div class="container content-space-2 content-space-lg-3">
            <div class="row">
                <div class="col-md-6">
                    <!-- Card -->
                    <div class="card shadow-lg">
                        <div class="card-body p-6">
                            <!-- Heading -->
                            <div class="text-center mb-5 mb-md-9">
                                <h2 class="display-5">Contact Form</h2>
                                <p>Whether you have questions or you would just like to say hello, contact us.</p>
                            </div>
                            <!-- End Heading -->

                            <!-- Form -->
                            <form class="contact-us-form">
                                <!-- Form -->

                                <fieldset class="border-light scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2">First Name</legend>
                                    <input type="text"
                                           class="form-control border-0"
                                           id="text_input_1"
                                           name="text-input-1"
                                           placeholder=""
                                           value="{{old('text_input_1')}}"/>


                                </fieldset>
                                <!-- End Form -->
                                <fieldset class="border-light mt-4 scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2">Last Name</legend>
                                    <input type="text"
                                           class="form-control"
                                           name="text-input-2"
                                           id="text_input_2"
                                           placeholder=""
                                           value="{{old('text_input_2')}}"/>
                                </fieldset>
                                <fieldset class="border-light mt-4 scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2">Email</legend>
                                    <input type="text"
                                           class="form-control"
                                           id="text_input_3"
                                           name="text-input-3"
                                           placeholder=""
                                           value="{{old('text_input_3')}}"/>
                                </fieldset>
                                <fieldset class="border-light mt-4 scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2">Subject</legend>
                                    <input type="text"
                                           class="form-control"
                                           id="text_input_4"
                                           name="text-input-4"
                                           placeholder=""
                                           value="{{old('text_input_4')}}"/>
                                </fieldset>
                                <fieldset class="border-light mt-4 scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2">Comments</legend>
                                    <textarea  class="form-control" id="text-input-5"
                                           placeholder="" value="Subject" rows="3"></textarea>
                                </fieldset>
                                <div class="d-block d-md-flex justify-content-center text-center contact-btn mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Send</button>
                                    <button type="submit" class="btn btn-secondary btn-lg ms-3">Reset</button>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109132.50717458608!2d72.21911081640624!3d31.265282300000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3923a3d944211f27%3A0xfe1509a2f8d6f2a5!2stravelforbes!5e0!3m2!1sen!2s!4v1655819155305!5m2!1sen!2s"
                                class="w-100" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Form -->
</x-guest-layout>
