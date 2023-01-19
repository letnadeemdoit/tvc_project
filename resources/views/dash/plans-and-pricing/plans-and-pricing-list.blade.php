<div x-data="{isYearly: {{ $this->subscription && $this->subscription->period === 'yearly' ? 1: 0  }}}">
    @if($this->subscription && $this->subscription->status === 'APPROVAL_PENDING')
        <div class="alert alert-success mb-4" role="alert">
            You have been subscribed successfully! Please wait until we confirm your plan.
        </div>
    @endif
    <div class="d-flex justify-content-center mb-4">
        <div class="form-check form-switch form-switch-between">
            <label class="form-check-label">Monthly</label>
            <input
                class="js-toggle-switch form-check-input"
                type="checkbox"
                x-model="isYearly"
                value="0"
                {{$this->subscription && $this->subscription->period === 'yearly' ? 'checked': '' }}

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
                                data-bs-toggle="modal" data-bs-target="#unsubscribeModal"
                                class="form-check-select-stretched-btn btn btn-primary"
                            >
                                Unsubscribe
                            </a>
                            {{--                            @endif--}}
                        @else
                            {{--                            @if($this->subscription->period !== 'yearly')--}}
                            <a
                                data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                data_value="{{ route('dash.paypal.revise', ['basic', 'monthly']) }}"
                                href="#!"
                                class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                            >
                                Downgrade
                            </a>
                            {{--                            @endif--}}
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
                    {{--                    <div class="d-grid mb-2">--}}
                    {{--                        <a href="#"--}}
                    {{--                           class="form-check-select-stretched-btn btn btn-outline-primary">Coming Soon..!</a>--}}
                    {{--                    </div>--}}
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['standard', 'monthly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'standard' && $this->subscription->period === 'monthly')
                            @if($this->subscription->status === 'APPROVAL_PENDING')
                                <p class="text-center text-info">Waiting payment confirmation from paypal!</p>
                            @else
                                <a
                                    href="#!"
                                    data-bs-toggle="modal" data-bs-target="#unsubscribeModal"
                                    class="form-check-select-stretched-btn btn btn-primary"
                                >
                                    Unsubscribe
                                </a>
                            @endif
                        @else
                            @if($this->subscription && $this->subscription->plan === 'basic' && $this->subscription->period === 'monthly')
                                <a
                                    data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                    data_value="{{ route('dash.paypal.revise', ['standard', 'monthly']) }}"
                                    href="#!"
                                    class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                >
                                    Upgrade
                                </a>
                            @elseif($this->subscription && $this->subscription->plan === 'premium')
                                <a
                                    data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                    data_value="{{ route('dash.paypal.revise', ['standard', 'monthly']) }}"
                                    href="#!"
                                    class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                >
                                    Downgrade
                                </a>
                            @else
                                <a
                                    data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                    data_value="{{ route('dash.paypal.revise', ['standard', 'monthly']) }}"
                                    href="#!"
                                    class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                >
                                    Downgrade
                                </a>
                            @endif
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
                    {{--                    <div class="d-grid mb-2">--}}
                    {{--                        <a href="#"--}}
                    {{--                           class="form-check-select-stretched-btn btn btn-outline-primary">Coming Soon..!</a>--}}
                    {{--                    </div>--}}
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['premium', 'monthly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'premium' && $this->subscription->period === 'monthly')
                            @if($this->subscription->status === 'APPROVAL_PENDING')
                                <p class="text-center text-info">Waiting payment confirmation from paypal!</p>
                            @else
                                <a
                                    href="#!"
                                    data-bs-toggle="modal" data-bs-target="#unsubscribeModal"
                                    class="form-check-select-stretched-btn btn btn-primary"
                                >Unsubscribe</a>
                            @endif
                        @else
                            @if($this->subscription && $this->subscription->period === 'yearly')
                                <a
                                    data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                    data_value="{{ route('dash.paypal.revise', ['premium', 'monthly']) }}"
                                    href="#!"
                                    class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                >
                                    Downgrade
                                </a>
                            @else
                                <a
                                    data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                    data_value="{{ route('dash.paypal.revise', ['premium', 'monthly']) }}"
                                    href="#!"
                                    class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                >
                                    Upgrade
                                </a>
                            @endif

                            {{--                            <p>Please unsubscribe other plan first!</p>--}}
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
                            @if($this->subscription->status === 'APPROVAL_PENDING')
                                <p class="text-center text-info">Waiting payment confirmation from paypal!</p>
                            @else
                                <a
                                    href="#!"
                                    data-bs-toggle="modal" data-bs-target="#unsubscribeModal"
                                    class="form-check-select-stretched-btn btn btn-primary"
                                >Unsubscribe</a>
                            @endif
                        @else
                            @if($this->subscription->period === 'monthly')
                                <a
                                    data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                    data_value="{{ route('dash.paypal.revise', ['basic', 'yearly']) }}"
                                    href="#!"
                                    class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                >
                                    Upgrade
                                </a>
                            @else
                                <a
                                    data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                    data_value="{{ route('dash.paypal.revise', ['basic', 'yearly']) }}"
                                    href="#!"
                                    class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                >
                                    Downgrade
                                </a>
                            @endif
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
                    {{--                    <div class="d-grid mb-2">--}}
                    {{--                        <a href="#"--}}
                    {{--                           class="form-check-select-stretched-btn btn btn-outline-primary">Coming Soon..!</a>--}}
                    {{--                    </div>--}}
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['standard', 'yearly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'standard' && $this->subscription->period === 'yearly')
                            @if($this->subscription->status === 'APPROVAL_PENDING')
                                <p class="text-center text-info">Waiting payment confirmation from paypal!</p>
                            @else
                                <a
                                    href="#!"
                                    data-bs-toggle="modal" data-bs-target="#unsubscribeModal"
                                    class="form-check-select-stretched-btn btn btn-primary"
                                >Unsubscribe</a>
                            @endif
                        @else
                            @if($this->subscription && $this->subscription->plan === 'basic' && $this->subscription->period === 'yearly')
                                <a
                                    data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                    data_value="{{ route('dash.paypal.revise', ['standard', 'yearly']) }}"
                                    href="#!"
                                    class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                >
                                    Upgrade
                                </a>
                            @elseif($this->subscription && $this->subscription->plan === 'premium' && $this->subscription->period === 'yearly')
                                <a
                                    data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                    data_value="{{ route('dash.paypal.revise', ['standard', 'yearly']) }}"
                                    href="#!"
                                    class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                >
                                    Downgrade
                                </a>
                            @else
                                @if($this->subscription->period === 'monthly')
                                    <a
                                        data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                        data_value="{{ route('dash.paypal.revise', ['standard', 'yearly']) }}"
                                        href="#!"
                                        class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                    >
                                        Upgrade
                                    </a>
                                @else
                                    <a
                                        data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                        data_value="{{ route('dash.paypal.revise', ['standard', 'yearly']) }}"
                                        href="#!"
                                        class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                                    >
                                        Downgrade
                                    </a>
                                @endif
                            @endif
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
                    {{--                    <div class="d-grid mb-2">--}}
                    {{--                        <a href="#"--}}
                    {{--                           class="form-check-select-stretched-btn btn btn-outline-primary">Coming Soon..!</a>--}}
                    {{--                    </div>--}}
                    <div class="d-grid mb-2">
                        @if(!$this->subscription)
                            <a href="{{ route('dash.paypal.process', ['premium', 'yearly']) }}"
                               class="form-check-select-stretched-btn btn btn-outline-primary">Subscribe</a>
                        @elseif($this->subscription && $this->subscription->plan === 'premium' && $this->subscription->period === 'yearly')
                            @if($this->subscription->status === 'APPROVAL_PENDING')
                                <p class="text-center text-info">Waiting payment confirmation from paypal!</p>
                            @else
                                <a
                                    href="#!"
                                    data-bs-toggle="modal" data-bs-target="#unsubscribeModal"
                                    class="form-check-select-stretched-btn btn btn-primary"
                                >Unsubscribe</a>
                            @endif
                        @else
                            <a
                                data-bs-toggle="modal" data-bs-target="#upgradeModal"
                                data_value="{{ route('dash.paypal.revise', ['premium', 'yearly']) }}"
                                href="#!"
                                class="form-check-select-stretched-btn btn btn-primary upgrade-downgrade"
                            >
                                Upgrade
                            </a>
                        @endif
                    </div>

                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Col -->

    </div>

    <div class="modal fade" id="unsubscribeModal" tabindex="-1" aria-labelledby="unsubscribeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <h6 class="modal-title fs-10 text-white"
                    id="deleteConfirmationModalLabel">{{ 'Delete!'}}</h6>
                <div class="modal-body text-center">
                    <div>
              <span class="rounded-circle text-primary border-primary"
                    style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-exclamation"></i>
                </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">Are you sure to unsubscribe plan.!</h4>
                    <p class="fw-500 fs-15">You would not be able to recover this!</p>
                    <div class="btn-group my-2">
                        <button type="button"
                                class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                data-bs-dismiss="modal">Cancel
                        </button>
                        <button type="button"
                                class="btn btn-primary fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                wire:click.prevent="cancelSubscription">
                            <div wire:loading.remove wire:target="cancelSubscription">
                                Yes,Unsubscribe!
                            </div>
                            <div wire:loading wire:target="cancelSubscription">
                                Unsubscribing...
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="upgradeModal" tabindex="-1" aria-labelledby="upgradeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <h6 class="modal-title fs-10 text-white"
                    id="deleteConfirmationModalLabel">{{ 'Delete!'}}</h6>
                <div class="modal-body text-center">
                    <div>
              <span class="rounded-circle text-primary border-primary"
                    style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-exclamation"></i>
                </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">Are you sure to change plan.!</h4>
{{--                    <p class="fw-500 fs-15">You would not be able to recover this!</p>--}}
                    <div class="btn-group my-2" id="confirmUpgrade">
                        <button type="button"
                                class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                data-bs-dismiss="modal">Cancel
                        </button>
                        <a
                            href="#"
                            class="btn btn-primary fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                        >
                            Yes,Proceed!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.upgrade-downgrade').click(function () {
                let value = $(this).attr('data_value');
                $('#confirmUpgrade a').attr('href', value);
            });
        });
    </script>
@endpush
