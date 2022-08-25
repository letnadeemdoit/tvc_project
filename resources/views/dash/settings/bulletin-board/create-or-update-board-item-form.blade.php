<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $boardItem && $boardItem->id ? "Update" . ($boardItem->title ? " '$boardItem->title'" : '') : 'Add' }} Board Item</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveBulletinBoardCU" method="post">
{{--                <x-jet-validation-errors />--}}

                @if($boardItem && $boardItem->image)
                    <div class="d-flex mb-3">
                        <div class="mx-auto position-relative">
                            <a
                                href="#"
                                class="position-absolute" style="right: 5px; top: 5px"
                                wire:click.prevent="deleteFile"
                            ><i class="bi-trash fs-3 pe-1 pt-1 text-dark text-white"></i></a>
                            <img src="{{ $boardItem->getFileUrl() }}" class="img-thumbnail" style="max-height: 200px" />
                        </div>
                    </div>
                @endif
                <x-upload-zone wire:model="file" />
                <x-jet-input-error for="image" />
                <br />


                <div class="mb-3">
                    <label class="form-label" for="category_id">Select Category</label>
                    <select id="category_id" wire:model.defer="state.category_id" class="form-control">
                        <option>Choose Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="mb-3">
                    <label class="form-label" for="title">Title</label>
                    <input
                        type="text"
                        id="title"
                        wire:model.defer="state.title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="Board Title"
                    />
                    @error('title')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div
                    class="mb-3"
                    @modal-is-shown.window="
                        window.tinymce.init({
                        ...window.TINYMCE_DEFAULT_CONFIG,
                        selector: 'textarea#board_textarea',
                        setup: function(editor) {
                                editor.on('change', function(e) {
                                    @this.set('state.Board', editor.getContent(), true);
                                });
                            }
                        })
                    "

                >
                    <label class="form-label" for="board_textarea">Board Detail</label>
                    <textarea
                        class="form-control @error('Board') is-invalid @enderror"
                        wire:model.defer="state.Board"
                        name="Board"
                        placeholder=""
                        rows="4"
                        id="board_textarea"

                    ></textarea>
                    @error('Board')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">{{ $boardItem && $boardItem->id ? "Update" : 'Add' }} Bulletin Board Item</button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
