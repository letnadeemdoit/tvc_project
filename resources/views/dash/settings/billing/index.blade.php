<x-settings>
    <x-slot name="title">
        Billing
    </x-slot>
    @if(!$user->appleSubscription())
        <x-slot name="headerRightActions">
            <div class="col-sm-auto">
                <a
                    href="#!"
                    data-bs-toggle="modal" data-bs-target="#unsubscribeModal"
                    class="form-check-select-stretched-btn btn btn-primary"
                >Unsubscribe</a>
            </div>
        </x-slot>
    @endif

    @if(session()->has('status'))
        <div class="alert alert-soft-success" role="alert">
            {{ session()->get('status') }}
        </div>
    @endif

    <livewire:settings.billing.billing-list :user="$user"/>

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

                        <a
                            class="btn btn-primary fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                            href="{{ route('dash.settings.unsubscribe-plan') }}"
                        >
                            Yes,Unsubscribe!
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-settings>
