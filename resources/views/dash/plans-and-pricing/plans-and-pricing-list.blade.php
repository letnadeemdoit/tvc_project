<div class="">
    <div class="row mb-3 justify-content-center">
        <div class="col-12 col-md-4 col-lg-4 mb-3">
            <!-- Card -->
            <div class="card card-lg form-check form-check-select-stretched h-100 zi-1 border border-primary">
                <div class="card-header text-center">
                    <span class="card-subtitle fw-bold">Basic</span>
                    <h2 class="card-title display-3 text-dark">
                        $<span id="pricingCount1" data-hs-toggle-switch-item-options='{
                             "min": 22,
                             "max": 32
                           }'>{{ number_format(20.00 / 11, 2) }}</span>
                        <span class="fs-6 text-muted">/ mon</span>
                    </h2>
                    <p class="card-text">1st month free pay payment annually ($20.00/year)</p>
                </div>

                <div class="card-body">
                    <!-- List Checked -->
                    <ul class="list-checked list-checked-primary mb-0">
                        <li class="list-checked-item">3 users</li>
                        <li class="list-checked-item">Front plan features</li>
                        <li class="list-checked-item">3 apps</li>
                        <li class="list-checked-item">Product support</li>
                    </ul>
                    <!-- End List Checked -->
                </div>

                <div class="card-footer border-0 text-center">
                    <div class="d-grid mb-2">
                        @if(!is_basic_subscribed())
                            <a href="{{ route('dash.paypal.process', 'basic') }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif(is_basic_subscribed())
                            <a href="https://www.{{ config('services.paypal.mode') === 'sandbox' ? 'sandbox.' : '' }}paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=payment%thevacationcalendar%2ecom"
                               class="form-check-select-stretched-btn btn btn-primary">Unsubscribe</a>
                        @endif
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Col -->

        <div class="col-12 col-md-4 col-lg-4 mb-3">
            <!-- Card -->
            <div class="card card-lg form-check form-check-select-stretched h-100 zi-1 border border-primary">
                <div class="card-header text-center">
                    <span class="card-subtitle fw-bold">Standard</span>
                    <h2 class="card-title display-3 text-dark">
                        $<span id="pricingCount1" data-hs-toggle-switch-item-options='{
                             "min": 22,
                             "max": 32
                           }'>{{ number_format(30.00 / 11, 2) }}</span>
                        <span class="fs-6 text-muted">/ mon</span>
                    </h2>
                    <p class="card-text">1st month free pay payment annually ($30.00/year)</p>
                </div>

                <div class="card-body">
                    <!-- List Checked -->
                    <ul class="list-checked list-checked-primary mb-0">
                        <li class="list-checked-item">3 users</li>
                        <li class="list-checked-item">Front plan features</li>
                        <li class="list-checked-item">3 apps</li>
                        <li class="list-checked-item">Product support</li>
                    </ul>
                    <!-- End List Checked -->
                </div>

                <div class="card-footer border-0 text-center">
                    <div class="d-grid mb-2">
                        @if(!is_standard_subscribed())
                            <a href="{{ route('dash.paypal.process', 'standard') }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif(is_standard_subscribed())
                            <a href="https://www.{{ config('services.paypal.mode') === 'sandbox' ? 'sandbox.' : '' }}paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=payment%thevacationcalendar%2ecom"
                               class="form-check-select-stretched-btn btn btn-primary">Unsubscribe</a>
                        @endif
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Col -->

        <div class="col-12 col-md-4 col-lg-4 mb-3">
            <!-- Card -->
            <div class="card card-lg form-check form-check-select-stretched h-100 zi-1 border border-primary">
                <div class="card-header text-center">
                    <span class="card-subtitle fw-bold">Premium</span>
                    <h2 class="card-title display-3 text-dark">
                        $<span id="pricingCount2" data-hs-toggle-switch-item-options='{
                             "min": 42,
                             "max": 54
                           }'>{{ number_format(40.00 / 11, 2) }}</span>
                        <span class="fs-6 text-muted">/ mon</span>
                    </h2>
                    <p class="card-text">1st month free pay payment annually ($40.00/year)</p>
                </div>

                <div class="card-body">
                    <!-- List Checked -->
                    <ul class="list-checked list-checked-primary mb-0">
                        <li class="list-checked-item">Unlimited users</li>
                        <li class="list-checked-item">Front plan features</li>
                        <li class="list-checked-item">Unlimited apps</li>
                        <li class="list-checked-item">Product support</li>
                    </ul>
                    <!-- End List Checked -->
                </div>

                <div class="card-footer border-0 text-center">
                    <div class="d-grid mb-2">
                        @if(!is_premium_subscribed())
                            <a href="{{ route('dash.paypal.process', 'premium') }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif(is_premium_subscribed())
                            <a href="https://www.{{ config('services.paypal.mode') === 'sandbox' ? 'sandbox.' : '' }}paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=payment%thevacationcalendar%2ecom"
                               class="form-check-select-stretched-btn btn btn-primary">Unsubscribe</a>
                        @endif
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

</div>

@push('scripts')

@endpush
