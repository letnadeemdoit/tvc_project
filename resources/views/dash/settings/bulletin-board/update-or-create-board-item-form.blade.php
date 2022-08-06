<x-modals.bs-modal wire:model="isShowingModal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Board Item</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                wire:click="$toggle('isShowingModal')"
            ></button>
        </div>
        <div class="modal-body">
        </div>
    </div>
</x-modals.bs-modal>
