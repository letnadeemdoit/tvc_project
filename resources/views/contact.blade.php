<x-guest-layout>
    @include('partials.sub-page-hero-section');

    <section class="text-center">
        <div class="container">
            <div class="row mb-5 section-padding">
                <div class="col-md-9 col-lg-5 mx-auto">
                    <div class="contact-text shadow-1-strong rounded  d-flex justify-content-center align-items-center">
                        <h1 class="text-primary font-vintage mb-0">Contact US</h1>
                    </div>
                    <h2 class="pt-2 popping-bold">We’d Love to Hear From You</h2>
                    <p class="pt-2">Thank you very much for visiting TheVacationCalendar.com. If you have any questions about the service, technical issues, or any other suggestions, please feel free to email.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form -->
    <div class="contact-page">
        <div class="container content-space-2 content-space-lg-3 " style="padding-top: 0 !important;">
            <div class="row gx-1">
                <div class="col-lg-6">
                    <!-- Card -->
                    <div class="card shadow-lg">
                        <div class="card-body p-6">
                            <!-- Heading -->
                            <div class="text-center mb-5 mb-md-9">
                                <h2 class="display-5">Contact Form</h2>
                                <p>Whether you have questions or you would just like to say hello, contact us.</p>
                            </div>
                            <!-- End Heading -->

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                             @endif

                        <!-- Form -->
                            <form action="{{route('guest.contact.mail')}}" method="post" id="contactForm">
                                @csrf
                                <fieldset class="input-group border rounded-1 ps-1">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">First Name</legend>
                                    <input type="text"
                                           class="form-control form-control-lg border-0 shadow-none outline-0"
                                           id="text_input_1"
                                           name="first_name"
                                           placeholder=""
                                           value="{{old('first_name')}}"/>
                                </fieldset>
                                @error('first_name')
                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                @enderror
                            <!-- End Form -->
                                <fieldset class="input-group border rounded-1 ps-1 mt-3">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Last Name</legend>
                                    <input type="text"
                                           class="form-control form-control-lg border-0 shadow-none outline-0"
                                           name="last_name"
                                           id="text_input_2"
                                           placeholder=""
                                           value="{{old('last_name')}}"/>
                                </fieldset>
                                @error('last_name')
                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                @enderror

                                <fieldset class="input-group border rounded-1 ps-1 mt-3">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Email</legend>
                                    <input type="text"
                                           class="form-control form-control-lg border-0 shadow-none outline-0l"
                                           id="text_input_3"
                                           name="email"
                                           placeholder=""
                                           value="{{old('email')}}"/>
                                </fieldset>
                                @error('email')
                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                @enderror

                                <fieldset class="input-group border rounded-1 ps-1 mt-3">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Subject</legend>
                                    <input type="text"
                                           class="form-control form-control-lg border-0 shadow-none outline-0"
                                           id="text_input_4"
                                           name="subject"
                                           placeholder=""
                                           value="{{old('subject')}}"/>
                                </fieldset>
                                @error('subject')
                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                @enderror

                                <fieldset class="input-group border rounded-1 ps-1 mt-3">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Comments</legend>
                                    <textarea  class="form-control form-control-lg border-0 shadow-none outline-0" name="comment" id="text-input-5" rows="4"></textarea>
                                </fieldset>
                                @error('comment')
                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                @enderror

                                <div class="btn gap-3 text-center mt-4 d-block d-md-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-lg rounded btn-min-160 px-5 border-0 shadow-lg">Send</button>
                                    <a href="#" onclick="resetForm()" class="btn  btn-lg bg-skin btn-min-160 shadow-lg rounded px-5 mt-3 mt-sm-0 border-0">Reset</a>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-6 mt-3 mt-lg-0">
                    <div class="card h-100">
                        <div class="card-body p-3">
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

@push('scripts')

        <script>
            function resetForm() {
                document.getElementById("contactForm").reset();
            }
        </script>

@endpush

</x-guest-layout>
