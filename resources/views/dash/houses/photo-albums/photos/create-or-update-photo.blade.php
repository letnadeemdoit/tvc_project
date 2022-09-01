<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $photo && $photo->PhotoId ? "Update" : 'Add' }} Photo
            </h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div
            class="modal-body"
            x-data="{}"
        >
            <form wire:submit.prevent="savePhotoCU" method="post">

                @if($photo && $photo->path)
                    <div class="d-flex mb-3">
                        <div class="mx-auto">
                            <img src="{{ $photo->getFileUrl() }}" class="img-thumbnail" style="max-height: 200px" />
                        </div>
                    </div>
                @endif

                <x-upload-zone wire:model="file" />
                <x-jet-input-error for="image" />
                    <br/>

                <div class="mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea
                        class="form-control"
                        wire:model.defer="state.description"
                        name="description"
                        placeholder=""
                        rows="4"
                        id="description"
                    ></textarea>
                </div>

                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">
                        {{ $photo && $photo->PhotoId ? "Update" : 'Add' }} Photo
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
