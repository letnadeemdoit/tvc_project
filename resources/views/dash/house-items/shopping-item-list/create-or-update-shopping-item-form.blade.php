<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $shoppingItemList && $shoppingItemList->id ? "Update" . ($shoppingItemList->title ? " '$shoppingItemList->title'" : '') : 'Add' }}
                Shopping Item</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveShoppingItemCU" method="post">

                <div>
                    @if($shoppingItemList && $shoppingItemList->image)
                        <div class="d-flex mb-3">
                            <div class="mx-auto">
                                <img src="{{ $shoppingItemList->getFileUrl() }}" class="img-thumbnail rounded" style="max-height: 120px"/>
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
                    <label class="form-label" for="title">Name</label>
                    <input
                        type="text"
                        id="title"
                        wire:model.defer="state.name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Shopping Item Name"
                    />
                    @error('name')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="title">Where to buy</label>
                    <input
                        type="text"
                        id="location"
                        wire:model.defer="state.location"
                        name="location"
                        class="form-control"
                        placeholder="where to buy"
                    />

                </div>

{{--                <div class="mb-3">--}}
{{--                    <label class="form-label" for="title">Expire Date</label>--}}
{{--                    <input--}}
{{--                        type="date"--}}
{{--                        id="expiration_date"--}}
{{--                        wire:model.defer="state.expiration_date"--}}
{{--                        name="expiration_date"--}}
{{--                        class="form-control"--}}
{{--                    />--}}

{{--                </div>--}}


                {{--                <div--}}
                {{--                    class="mb-3"--}}
                {{--                    @modal-is-shown.window="--}}
                {{--                        window.tinymce.init({--}}
                {{--                        ...window.TINYMCE_DEFAULT_CONFIG,--}}
                {{--                        selector: 'textarea#description',--}}
                {{--                        setup: function(editor) {--}}
                {{--                                editor.on('change', function(e) {--}}
                {{--                                    @this.set('state.description', editor.getContent(), true);--}}
                {{--                                });--}}
                {{--                            }--}}
                {{--                        })--}}
                {{--                    "--}}
                {{--                >--}}
                {{--                    <label class="form-label" for="description">Description</label>--}}
                {{--                    <textarea--}}
                {{--                        class="form-control"--}}
                {{--                        wire:model.defer="state.description"--}}
                {{--                        name="description"--}}
                {{--                        placeholder=""--}}
                {{--                        rows="3"--}}
                {{--                        id="description"--}}

                {{--                    ></textarea>--}}
                {{--                </div>--}}

                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">
                        {{ $shoppingItemList && $shoppingItemList->id ? "Update" . ($shoppingItemList->title ? " '$shoppingItemList->title'" : '') : 'Add' }} Shopping Item
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
