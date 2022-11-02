<div class="modal fade hideableModal" id="deleteConfirmation{{ $id ?? 0 }}Modal" tabindex="-1"
     aria-labelledby="deleteConfirmation{{ $id ?? 0 }}ModalLabel" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h6 class="modal-title fs-10 text-white"
                id="deleteConfirmation{{ $id ?? 0 }}ModalLabel">{{ $title ?? 'Delete!'}}</h6>
            <div class="modal-body text-center">
                <div>
                  <span class="rounded-circle text-primary border-primary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-exclamation"></i>
                </span>
                </div>

                <h4 class="fw-bold text-center my-3"
                    style="color: #00000090">{!! $title ?? 'Are you sure?'!!}</h4>
                <p class="fw-500 fs-15">{!! $description ?? 'You would not be able to recover this!' !!}</p>
                <div class="btn-group my-2">
                    <button type="button"
                            class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                            data-bs-dismiss="modal">Cancel
                    </button>
                    <button type="button"
                            class="btn btn-primary fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                            wire:click.prevent="{{$action}}">
                        <div wire:loading.remove wire:target="{{$action}}">
                            Yes,Delete!
                        </div>
                        <div wire:loading wire:target="{{$action}}">
                            Deleting...
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
