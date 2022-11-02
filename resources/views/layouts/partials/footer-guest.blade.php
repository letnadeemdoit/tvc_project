<!-- Footer -->
<div class="bg-dark-blue footer-primary">
    <div class="container py-3">
        <div class="row row-max-width align-items-center">
            <div class="col-12 col-lg-6 col-xl-6">
                <div class="fs-6 footer-text mb-2 mb-md-0 text-white d-flex align-items-center justify-content-center justify-content-lg-start">
                    <p class="mb-0"> Powered by {{ config('app.name') }}.</p>
                    <a href="https://www.facebook.com/thevacationcalendar" class="text-decoration-none text-white ps-3">
{{--                        <i class="fa-brands fa-facebook-f fs-3"></i>--}}
                        <img src="{{asset('/images/images-home/facebook.svg')}}" class="img-fluid">
                    </a>
                    <a href="https://twitter.com/TheVacationCal" class="text-decoration-none text-white">
{{--                        <i class="bi-twitter mx-3 fs-3"></i>--}}
                        <img src="{{asset('/images/images-home/twitter.svg')}}" class="img-fluid mx-3">
                    </a>
                    <a href="https://www.instagram.com/thevacationcalendar/" class="text-decoration-none text-white">
{{--                        <i class="fa-brands fa-instagram fs-3"></i>--}}
                        <img src="{{asset('/images/images-home/instagram.svg')}}" class="img-fluid">
                    </a>
                    <div class="border-end border-light ps-3 d-none d-lg-block h-20"></div>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-12 col-lg-6 footer-text col-xl-6 text-center text-lg-end text-white mt-2 mt-lg-0">
                <p class="mb-0 fs-6 "> © 2022 {{ config('app.name') }}. <a href="{{route('guest.privacy-policy')}}" class="text-decoration-underline text-white">Privacy Policy</a> and <a href="{{route('guest.terms-of-service')}}" class="text-decoration-underline text-white">Terms of Service</a></p>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>
<!-- End Footer -->
