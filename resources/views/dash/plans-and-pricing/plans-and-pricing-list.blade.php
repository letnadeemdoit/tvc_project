<div>
    <div class="row mb-3 d-flex justify-content-center">
        <div class="col-12 col-md-4 col-lg-3 mb-3">
            <!-- Card -->
            <livewire:pay-pal.pricing-plan-card />
            <!-- End Card -->
        </div>
        <!-- End Col -->

        <div class="col-12 col-md-4 col-lg-3 mb-3">
            <!-- Card -->
            <div class="card card-lg form-check form-check-select-stretched h-100 zi-1 border border-primary">
                <div class="card-header text-center">
                    <span class="card-subtitle fw-bold">Standard</span>
                    <h2 class="card-title display-3 text-dark">
                        $<span id="pricingCount1" data-hs-toggle-switch-item-options='{
                             "min": 22,
                             "max": 32
                           }'>32</span>
                        <span class="fs-6 text-muted">/ mon</span>
                    </h2>
                    <p class="card-text">Or prepay monthly</p>
                </div>

                <div class="card-body d-flex justify-content-center">
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
                        <button type="button" class="form-check-select-stretched-btn btn btn-outline-primary">Select plan</button>
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Col -->

        <div class="col-12 col-md-4 col-lg-3 mb-3">
            <!-- Card -->
            <div class="card card-lg form-check form-check-select-stretched h-100 zi-1 border border-primary">
                <div class="card-header text-center">
                    <span class="card-subtitle fw-bold">Premium</span>
                    <h2 class="card-title display-3 text-dark">
                        $<span id="pricingCount2" data-hs-toggle-switch-item-options='{
                             "min": 42,
                             "max": 54
                           }'>54</span>
                        <span class="fs-6 text-muted">/ mon</span>
                    </h2>
                    <p class="card-text">Or prepay annually</p>
                </div>

                <div class="card-body d-flex justify-content-center">
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
                    <div id="paypal-button-container-P-7K271521FJ429705GMMEF62A"></div>
                    <script src="https://www.paypal.com/sdk/js?client-id=AdSqJ0MimC0olnFXkIkii8bmO7IFEJNKpSBQoWVFuKKI1XCN5ieL7XWzKk-TgqX0Yedsc6Omx-IzVDU9&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
                    <script>
                        paypal.Buttons({
                            style: {
                                shape: 'pill',
                                color: 'black',
                                layout: 'horizontal',
                                label: 'subscribe'
                            },
                            createSubscription: function(data, actions) {
                                return actions.subscription.create({
                                    /* Creates the subscription */
                                    plan_id: 'P-7K271521FJ429705GMMEF62A'
                                });
                            },
                            onApprove: function(data, actions) {
                                alert(data.subscriptionID); // You can add optional success message for the subscriber here
                            }
                        }).render('#paypal-button-container-P-7K271521FJ429705GMMEF62A'); // Renders the PayPal button
                    </script>
                    <div class="d-grid mb-2">
                        <button type="button" class="form-check-select-stretched-btn btn btn-outline-primary">Select plan</button>
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
