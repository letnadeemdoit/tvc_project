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
                <x-jet-validation-errors />
                <x-upload-zone
                    wire:model="file"

                    @if($boardItem && $boardItem->id)
                        :files="[$boardItem->]"
                    @endif
                />
                <x-jet-input-error for="image" />
                <br />

                <div class="mb-3">
                    <label class="form-label" for="exampleFormControlSelect1">Select Category</label>
                    <select id="exampleFormControlSelect1" class="form-control">
                        <option>Choose Category</option>
                        <option>category one</option>
                        <option>category two</option>
                        <option>category three</option>
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
                    <button type="submit" class="btn btn-primary px-5 ms-auto">{{ $boardItem && $boardItem->id ? "Update" . ($boardItem->title ? " '$boardItem->title'" : '') : 'Add' }} Board Item</button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
