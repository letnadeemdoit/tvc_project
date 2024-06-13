<x-modals.bs-modal class="modal-dialog-centered">
    <div class="modal-content">
        <h6 class="modal-title fs-10 text-white"
            id="deleteConfirmationModalLabel">{{ 'Delete!'}}</h6>
        <div class="modal-body text-center">
            <div>
              <span class="rounded-circle text-primary border-primary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-exclamation"></i>
                </span>
            </div>

            <h4 class="fw-bold text-center my-3"
                style="color: #00000090">{!! $confirmationContent['title'] ?? 'Are you sure?'!!}</h4>
            <p class="fw-500 fs-15">{!! $confirmationContent['description'] ?? 'You would not be able to recover this!' !!}</p>
            <div class="btn-group my-2">
                <button type="button"
                        class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                        @click.prevent="hide()">Cancel
                </button>
                <button type="button"
                        class="btn btn-primary fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                        wire:click.prevent="destroy">
                    <div wire:loading.remove wire:target="destroy">
                        {{ $this->reject === 'rejected' ? 'Yes,Reject!' : 'Yes,Delete!'}}
                    </div>
                    <div wire:loading wire:target="destroy">
                        {{ $this->reject === 'rejected' ? 'Rejecting...' : 'Deleting...'}}
                    </div>
                </button>
            </div>
        </div>
    </div>
</x-modals.bs-modal>
