<div x-data="{isYearly: 0}">

    <div class="d-flex justify-content-center mb-4">
        <div class="form-check form-switch form-switch-between">
            <label class="form-check-label">Monthly</label>
            <input
                class="js-toggle-switch form-check-input"
                type="checkbox"
                x-model="isYearly"
                value="0"
            />
            <label class="form-check-label">Annually</label>
        </div>
    </div>

    <!-- Monthly -->
    <div class="row mb-3 justify-content-center" x-show="!isYearly">
        <div class="col-12 col-md-4 col-lg-4 mb-3">
            <!-- Card -->
            <div class="card card-lg form-check form-check-select-stretched h-100 zi-1 border border-primary">
                <div class="card-header text-center">
                    <span class="card-subtitle fw-bold">Basic</span>
                    <h2 class="card-title display-3 text-dark">
                        $5
                        <span class="fs-6 text-muted">/ mon</span>
                    </h2>
                    <p class="card-text">Billed monthly</p>
                </div>

                <div class="card-body">
                    <!-- List Checked -->
                    <ul class="list-checked list-checked-primary mb-0">
                        <li class="list-checked-item">Basic site functionality</li>
                    </ul>
                    <!-- End List Checked -->
                </div>

                <div class="card-footer border-0 text-center">
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['basic', 'monthly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'basic' && $this->subscription->period === 'monthly')
                            <a
                                href="#!"
                                wire:click.prevent="cancelSubscription"
                                class="form-check-select-stretched-btn btn btn-primary"
                            >
                                Unsubscribe
                            </a>
                        @else
                            <p>Please unsubscribe other plan first!</p>
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
                        $7
                        <span class="fs-6 text-muted">/ mon</span>
                    </h2>
                    <p class="card-text">Billed monthly</p>
                </div>

                <div class="card-body">
                    <!-- List Checked -->
                    <ul class="list-checked list-checked-primary mb-0">
                        <li class="list-checked-item">Basic site functionality</li>
                        <li class="list-checked-item">Manage up to 6 rooms</li>
                    </ul>
                    <!-- End List Checked -->
                </div>

                <div class="card-footer border-0 text-center">
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['standard', 'monthly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'standard' && $this->subscription->period === 'monthly')
                            <a
                                href="#!"
                                wire:click.prevent="cancelSubscription"
                                class="form-check-select-stretched-btn btn btn-primary"
                            >
                                Unsubscribe
                            </a>
                        @else
                            <p>Please unsubscribe other plan first!</p>
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
                        $9
                        <span class="fs-6 text-muted">/ mon</span>
                    </h2>
                    <p class="card-text">Billed monthly</p>
                </div>

                <div class="card-body">
                    <!-- List Checked -->
                    <ul class="list-checked list-checked-primary mb-0">
                        <li class="list-checked-item">Full site functionality</li>
                        <li class="list-checked-item">Unlimited rooms</li>
                        <li class="list-checked-item">Manage up to 9 additional properties</li>
                    </ul>
                    <!-- End List Checked -->
                </div>

                <div class="card-footer border-0 text-center">
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['premium', 'monthly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'premium' && $this->subscription->period === 'monthly')
                            <a
                                href="#!"
                                wire:click.prevent="cancelSubscription"
                                class="form-check-select-stretched-btn btn btn-primary"
                            >Unsubscribe</a>
                        @else
                            <p>Please unsubscribe other plan first!</p>
                        @endif
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Col -->

    </div>
    <!-- Yearly -->
    <div class="row mb-3 justify-content-center" x-show="isYearly" style="display: none">
        <div class="col-12 col-md-4 col-lg-4 mb-3">
            <!-- Card -->
            <div class="card card-lg form-check form-check-select-stretched h-100 zi-1 border border-primary">
                <div class="card-header text-center">
                    <span class="card-subtitle fw-bold">Basic</span>
                    <h2 class="card-title display-3 text-dark">
                        $40
                        <span class="fs-6 text-muted">/ year</span>
                    </h2>
                    <p class="card-text">Billed annually</p>
                </div>

                <div class="card-body">
                    <!-- List Checked -->
                    <ul class="list-checked list-checked-primary mb-0">
                        <li class="list-checked-item">Basic site functionality</li>
                    </ul>
                    <!-- End List Checked -->
                </div>

                <div class="card-footer border-0 text-center">
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['basic', 'yearly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'basic' && $this->subscription->period === 'yearly')
                            <a
                                href="#!"
                                wire:click.prevent="cancelSubscription"
                                class="form-check-select-stretched-btn btn btn-primary"
                            >Unsubscribe</a>
                        @else
                            <p>Please unsubscribe other plan first!</p>
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
                        $60
                        <span class="fs-6 text-muted">/ year</span>
                    </h2>
                    <p class="card-text">Billed annually</p>
                </div>

                <div class="card-body">
                    <!-- List Checked -->
                    <ul class="list-checked list-checked-primary mb-0">
                        <li class="list-checked-item">Basic site functionality</li>
                        <li class="list-checked-item">Manage up to 6 rooms</li>
                    </ul>
                    <!-- End List Checked -->
                </div>

                <div class="card-footer border-0 text-center">
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['standard', 'yearly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'standard' && $this->subscription->period === 'yearly')
                            <a
                                href="#!"
                                wire:click.prevent="cancelSubscription"
                                class="form-check-select-stretched-btn btn btn-primary"
                            >Unsubscribe</a>
                        @else
                            <p>Please unsubscribe other plan first!</p>
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
                        $80
                        <span class="fs-6 text-muted">/ year</span>
                    </h2>
                    <p class="card-text">Billed annually</p>
                </div>

                <div class="card-body">
                    <!-- List Checked -->
                    <ul class="list-checked list-checked-primary mb-0">
                        <li class="list-checked-item">Full site functionality</li>
                        <li class="list-checked-item">Unlimited rooms</li>
                        <li class="list-checked-item">Manage up to 9 additional properties</li>
                    </ul>
                    <!-- End List Checked -->
                </div>

                <div class="card-footer border-0 text-center">
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['premium', 'yearly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'premium' && $this->subscription->period === 'yearly')
                            <a
                                href="#!"
                                wire:click.prevent="cancelSubscription"
                                class="form-check-select-stretched-btn btn btn-primary"
                            >Unsubscribe</a>
                        @else
                            <p>Please unsubscribe other plan first!</p>
                        @endif
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Col -->

    </div>
</div>

@push('scripts')

@endpush
