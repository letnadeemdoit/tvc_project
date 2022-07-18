<!-- Footer -->
<div class="footer d-flex align-items-center mt-5">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col d-flex align-items-center">
                <p class="fs-6 mb-0">Powered by {{ config('app.name') }}.</p>
                <div class="ps-3">
                <i class="bi-facebook fs-3"></i>
                <i class="bi-twitter mx-3 fs-3"></i>
                <i class="bi-instagram fs-3"></i>
            </div>
                <div class="border-right ps-3"></div>
            </div>
            <!-- End Col -->

            <div class="col-auto">
                <div class="d-flex justify-content-end">
                    <!-- List Separator -->
                    <ul class="list-inline list-separator">

                        <li class="list-inline-item">
                            <a class="list-separator-link" href="{{ route('guest.help') }}">© 2021 Compay name.<span class="text-decoration-underline">Privacy Policy</span> and <span class="text-decoration-underline"> Terms of Service</span></a>
                        </li>

                    </ul>
                    <!-- End List Separator -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>
<!-- End Footer -->
