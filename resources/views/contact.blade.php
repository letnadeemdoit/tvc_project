<x-guest-layout>
    @include('partials.sub-page-hero-section');

    <section class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="contact-text shadow-1-strong rounded  d-flex justify-content-center mt-5">
                        <h1 class="text-primary font-jost">Find Your Vacation House</h1>
                    </div>
                    <h3 class="pt-2">We’d Love to Hear From You</h3>
                    <p class="pt-2">Thank you very much for visiting TheVacationCalendar.com. If you have any questions about the service, technical issues, or any other suggestions, please feel free to email.</p>
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
                            <form action="{{route('guest.contact.mail')}}" method="post">
                                @csrf
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <!-- Form -->
                                        <div class="mb-3">
                                            <label class="form-label" for="hireUsFormFirstName">First name</label>
                                            <input type="text" class="form-control form-control-lg" name="first_name" id="hireUsFormFirstName" placeholder="First name" aria-label="First name">
                                        </div>
                                        <!-- End Form -->
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-sm-6">
                                        <!-- Form -->
                                        <div class="mb-3">
                                            <label class="form-label" for="hireUsFormLasttName">Last name</label>
                                            <input type="text" class="form-control form-control-lg" name="last_name" id="hireUsFormLasttName" placeholder="Last name" aria-label="Last name">
                                        </div>
                                        <!-- End Form -->
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->

                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <!-- Form -->
                                        <div class="mb-3">
                                            <label class="form-label" for="hireUsFormWorkEmail">Email address</label>
                                            <input type="email" class="form-control form-control-lg" name="email" id="hireUsFormWorkEmail" placeholder="email@site.com" aria-label="email@site.com">
                                        </div>
                                        <!-- End Form -->
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-sm-6">
                                        <!-- Form -->
                                        <div class="mb-3">
                                            <label class="form-label" for="hireUsFormPhone">Phone <span class="form-label-secondary">(Optional)</span></label>
                                            <input type="text" class="form-control form-control-lg" name="phone" id="hireUsFormPhone" placeholder="+x(xxx)xxx-xx-xx" aria-label="+x(xxx)xxx-xx-xx">
                                        </div>
                                        <!-- End Form -->
                                    </div>

                                    <div class="col-sm-6">
                                        <!-- Form -->
                                        <div class="mb-3">
                                            <label class="form-label" for="subject">Subject <span class="form-label-secondary"></span></label>
                                            <input type="text" class="form-control form-control-lg" name="subject" id="subject" placeholder="Subject" aria-label="Subject">
                                        </div>
                                        <!-- End Form -->
                                    </div>


                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->

                                <!-- Form -->
                                <div class="mb-3">
                                    <label class="form-label" for="hireUsFormDetails">Details</label>
                                    <textarea class="form-control form-control-lg" name="detail" id="hireUsFormDetails" placeholder="Tell us about your ..." aria-label="Tell us about your ..." rows="4"></textarea>
                                </div>
                                <!-- End Form -->

                                <div class="d-flex justify-content-center contact-btn">
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
                    <div class="card">
                        <div class="card-body">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109132.50717458608!2d72.21911081640624!3d31.265282300000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3923a3d944211f27%3A0xfe1509a2f8d6f2a5!2stravelforbes!5e0!3m2!1sen!2s!4v1655819155305!5m2!1sen!2s" class="w-100" height="570" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Form -->



</x-guest-layout>
