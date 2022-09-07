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

                <div>
                    @if($photo && $photo->path)
                        <div class="d-flex mb-3">
                            <div class="mx-auto">
                                <img src="{{ $photo->getThumbnailUrl(\App\Models\Photo\Photo::$THUMBNAIL_MEDIUM, 'path') }}" class="img-thumbnail rounded" style="max-height: 120px"/>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <x-upload-zone wire:model="file" />
                    <x-jet-input-error for="image" />
                </div>
                <br/>


                <div class="mb-3">
                    <label class="form-label" for="description">Description:</label>
                    <textarea
                        wire:model.defer="state.description"
                        name="description"
                        placeholder="Description"
                        rows="4"
                        id="description"
                        class="form-control @error('description') is-invalid @enderror"
                    ></textarea>
                    @error('description')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
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
