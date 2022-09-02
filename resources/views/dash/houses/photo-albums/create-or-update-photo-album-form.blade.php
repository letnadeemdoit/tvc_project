<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $album && $album->id ? "Update" : 'Add' }} Photo Album</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveAlbumCU" method="post">
                <div>
                    @if($album && $album->image)
                        <div class="d-flex mb-3">
                            <div class="mx-auto">
                                <img src="{{ $album->getFileUrl() }}" class="img-thumbnail rounded" style="max-height: 120px"/>
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
                    <label class="form-label" for="">Select Parent Album</label>
                    <select name="parent_id" id="parent_id"
                            wire:model.defer="state.parent_id" class="form-control">
                        <option value="" selected>Select parent Album...</option>
                        @forelse($albumCategory as $ac)
                            <option value="{{$ac->id}}">{{$ac->name}}</option>
                        @empty
                            <option value="" disabled selected>Create another album to select parent album</option>
                        @endforelse
                    </select>

                </div>

                <div class="mb-3">
                    <label class="form-label" for="title">Name</label>
                    <input
                        type="text"
                        id="name"
                        wire:model.defer="state.name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Name"
                    />
                    @error('name')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>


                <div
                    class="mb-3"
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
                >
                    <label class="form-label" for="description">Description</label>
                    <textarea
                        class="form-control"
                        wire:model.defer="state.description"
                        name="description"
                        placeholder="Description"
                        rows="5"
                        id="description"

                    ></textarea>
                </div>

                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">
                        {{ $album && $album->id ? "Update" : 'Add' }} Photo Album
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
