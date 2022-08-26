<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $categoryItem && $categoryItem->id ? "Update" : 'Add' }}
                Category</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveCategoryItemCU" method="post">
                @if($categoryItem && $categoryItem->image)
                    <div class="d-flex mb-3">
                        <div class="mx-auto position-relative">
                            <a
                                href="#"
                                class="position-absolute" style="right: 5px; top: 5px"
                                wire:click.prevent="deleteFile"
                            ><i class="bi-trash fs-3 pe-1 pt-1 text-dark text-white"></i></a>
                            <img src="{{ $categoryItem->getFileUrl() }}" class="img-thumbnail" style="max-height: 200px"/>
                        </div>
                    </div>
                @endif
                <x-upload-zone wire:model="file"/>
                <x-jet-input-error for="image"/>
                <br/>

                <div class="row">

                    <div class="mb-3 col-12 col-lg-12">
                        <label class="form-label" for="title">Name</label>
                        <input
                            type="text"
                            id="name"
                            wire:model.defer="state.name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="name"
                        />
                        @error('name')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>


                </div>

                <div class="row">
                    <div class="mb-3 col-12 col-lg-12">
                        <label class="form-label" for="exampleFormControlSelect1">Select Type</label>
                        <select id="exampleFormControlSelect1" wire:model.defer="state.type" class="form-control">
                            <option>-- Select --</option>
                            <option value="blog">Blog</option>
                            <option value="bulletin-board">Bulletins</option>
                            <option value="local-guide">LocalGuide</option>
                        </select>
                        @error('type')
                        <span class="invalid-feedback d-block">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">


                    <div
                        class="mb-3"
                        @modal-is-shown.window="
                        window.tinymce.init({
                        ...window.TINYMCE_DEFAULT_CONFIG,
                        selector: 'textarea#description',
                        setup: function(editor) {
                                editor.on('change', function(e) {
                                    @this.set('state.description', editor.getContent(), true);
                                });
                            }
                        })
                    "

                    >
                        <label class="form-label" for="description_textarea">Description</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            wire:model.defer="state.description"
                            name="description"
                            placeholder=""
                            rows="3"
                            id="description"

                        ></textarea>
                        @error('description')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>


                    {{--                    <div class="mb-3 col-12 col-lg-12">--}}
                    {{--                        <label class="form-label" for="title">Content</label>--}}
                    {{--                        <textarea--}}
                    {{--                            class="form-control @error('Content') is-invalid @enderror"--}}
                    {{--                            wire:model.defer="state.Content"--}}
                    {{--                            name="Content"--}}
                    {{--                            placeholder="Content"--}}
                    {{--                            rows="4"--}}
                    {{--                            id="board_textarea"--}}

                    {{--                        ></textarea>--}}
                    {{--                        @error('Content')--}}
                    {{--                        <span class="invalid-feedback">{{$message}}</span>--}}
                    {{--                        @enderror--}}
                    {{--                    </div>--}}


                </div>



                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">
                        {{ $categoryItem && $categoryItem->id ? "Update" : 'Add' }} Category Item
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
