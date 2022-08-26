<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $blogItem && $blogItem->BlogId ? "Update" : 'Add' }}
                Blog</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveBlogItemCU" method="post">

                @if($blogItem && $blogItem->image)
                    <div class="d-flex mb-3">
                        <div class="mx-auto position-relative">
                            <a
                                href="#"
                                class="position-absolute" style="right: 5px; top: 5px"
                                wire:click.prevent="deleteFile"
                            ><i class="bi-trash fs-3 pe-1 pt-1 text-dark text-white"></i></a>
                            <img src="{{ $blogItem->getFileUrl() }}" class="img-thumbnail" style="max-height: 200px"/>
                        </div>
                    </div>
                @endif
                <x-upload-zone wire:model="file"/>
                <x-jet-input-error for="image"/>
                <br/>
                {{--                <div--}}
                {{--                    class="mb-3"--}}
                {{--                    x-data="{isFileDropping: false, isUploadingFile: false, uploadingProgress: 0}"--}}
                {{--                    x-on:drop="isFileDropping = false"--}}
                {{--                    x-on:drop.prevent="--}}
                {{--                        if ($event.dataTransfer.files.length > 0 ) {--}}
                {{--                            isUploadingFile = true;--}}
                {{--                            var allowedExtensions = /(\/jpg|\/jpeg|\/png|\/gif)$/i;--}}
                {{--                            var fileTypeCheck = $event.dataTransfer.files[0].type;--}}
                {{--                            if (!allowedExtensions.exec(fileTypeCheck)) {--}}
                {{--                                $('.showErrorMsg').addClass('d-block');--}}
                {{--                                return;--}}
                {{--                             }--}}
                {{--                            $('.showErrorMsg').addClass('d-none');--}}
                {{--                            @this.upload( 'file', $event.dataTransfer.files[0],--}}
                {{--                                (uploadedFilename) => {--}}
                {{--                                }, () => {--}}

                {{--                                }, (event) => {--}}
                {{--                                    uploadingProgress = event.detail.progress;--}}
                {{--                                });--}}
                {{--                        }--}}
                {{--                    "--}}
                {{--                    x-on:dragover.prevent="isFileDropping = true"--}}
                {{--                    x-on:dragleave.prevent="isFileDropping = false"--}}
                {{--                    @modal-is-showing--}}
                {{--                >--}}

                {{--                    <label class="form-label" for="">Upload Your Visit Selfie</label>--}}
                {{--                    <div class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">--}}
                {{--                        @if($blogItem && !is_null($blogItem->image))--}}
                {{--                            --}}{{--           TODO:  need to fix the design               --}}
                {{--                            <div class="col h-100">--}}
                {{--                                <div class="dz-preview dz-file-preview">--}}
                {{--                                    <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"--}}
                {{--                                       wire:click.prevent="deleteFile">--}}
                {{--                                        <small class="bi-x" data-dz-remove></small>--}}
                {{--                                    </a>--}}
                {{--                                    <div class="dz-details d-flex">--}}
                {{--                                        <div class="dz-img flex-shrink-0 ">--}}
                {{--                                            <img class="dz-img-inner" data-dz-thumbnail src="{{ $blogItem->getFileUrl() }}" width="75px" />--}}
                {{--                                        </div>--}}

                {{--                                        <div class="dz-file-wrapper flex-grow-1 d-flex align-items-center">--}}
                {{--                                            <h6 class="dz-filename">--}}
                {{--                                                @if($file)--}}
                {{--                                                    <span class="dz-title ps-5 ms-2" data-dz-name>--}}
                {{--                                                        {{ $file->getClientOriginalName() }}--}}
                {{--                                                    </span>--}}
                {{--                                                @endif--}}
                {{--                                            </h6>--}}
                {{--                                            <div class="dz-size" data-dz-size></div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="d-flex align-items-center">--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        @endif--}}
                {{--                        <div class="dz-message">--}}
                {{--                            <h5>Drag and drop your file here</h5>--}}
                {{--                            <p class="mb-2">or</p>--}}
                {{--                            <div class="text-center"--}}
                {{--                                 x-on:livewire-upload-start="isUploadingFile = true"--}}
                {{--                                 x-on:livewire-upload-finish=""--}}
                {{--                                 x-on:livewire-upload-error=""--}}
                {{--                                 x-on:livewire-upload-progress="uploadingProgress = $event.detail.progress"--}}
                {{--                            >--}}
                {{--                                <input--}}
                {{--                                    id="file_upload"--}}
                {{--                                    type="file"--}}
                {{--                                    name="image"--}}
                {{--                                    hidden="hidden"--}}
                {{--                                    wire:model="file"--}}
                {{--                                    x-ref="file_upload"--}}
                {{--                                    accept=".jpg,.png,.jpeg,.gif,.tiff"--}}
                {{--                                />--}}
                {{--                                <button class="btn bg-primary btn-sm text-white"--}}
                {{--                                        @click.prevent="$refs.file_upload.click()">Upload Image--}}
                {{--                                </button>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="col h-100 mt-4" style="display: none" x-show="isUploadingFile">--}}
                {{--                            <div class="dz-preview dz-file-preview">--}}
                {{--                                <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"--}}
                {{--                                   @click.prevent="$wire.set('file', null); isUploadingFile = false">--}}
                {{--                                    <small class="bi-x" data-dz-remove></small>--}}
                {{--                                </a>--}}
                {{--                                <div class="dz-details d-flex">--}}
                {{--                                    <div class="dz-img flex-shrink-0 ">--}}
                {{--                                        @if($file && in_array($file->getClientOriginalExtension(), config('livewire.temporary_file_upload.preview_mimes')))--}}
                {{--                                            <img class="dz-img-inner" data-dz-thumbnail--}}
                {{--                                                 src="{{ $file->temporaryUrl() }}" width="75px" />--}}
                {{--                                        @endif--}}
                {{--                                    </div>--}}

                {{--                                    <div class="dz-file-wrapper flex-grow-1 d-flex align-items-center">--}}
                {{--                                        <h6 class="dz-filename">--}}
                {{--                                            @if($file)--}}
                {{--                                                <span class="dz-title ps-5 ms-2" data-dz-name>--}}
                {{--                                                    {{ $file->getClientOriginalName() }}--}}
                {{--                                                </span>--}}
                {{--                                            @endif--}}
                {{--                                        </h6>--}}
                {{--                                        <div class="dz-size" data-dz-size></div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}

                {{--                                <div class="dz-progress progress">--}}
                {{--                                    <div--}}
                {{--                                        class="dz-upload progress-bar bg-success"--}}
                {{--                                        role="progressbar"--}}
                {{--                                        x-bind:style="'width:' + `${uploadingProgress}%`"--}}
                {{--                                        aria-valuenow="0"--}}
                {{--                                        aria-valuemin="0"--}}
                {{--                                        aria-valuemax="100"--}}
                {{--                                        data-dz-uploadprogress>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="d-flex align-items-center">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <span class="showErrorMsg fw-semi-bold mt-1" style="font-size: 13px !important;color: #ff0000 !important;display: none">Only jpg,png,giff,tiff are allowed</span>--}}
                {{--                    @error('image')--}}
                {{--                    <span class="invalid-feedback d-block">{{$message}}</span>--}}
                {{--                    @enderror--}}
                {{--                </div>--}}

                <div class="row">

                    <div class="mb-3 col-12 col-lg-12">
                        <label class="form-label" for="title">Subject</label>
                        <input
                            type="text"
                            id="Subject"
                            wire:model.defer="state.Subject"
                            name="Subject"
                            class="form-control @error('Subject') is-invalid @enderror"
                            placeholder="Subject"
                        />
                        @error('Subject')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>


                </div>

                <div class="row">
                    <div class="mb-3 col-12 col-lg-12">
                        <label class="form-label" for="exampleFormControlSelect1">Select Category</label>
                        <select id="exampleFormControlSelect1" wire:model.defer="state.category_id"
                                class="form-control">
                            <option>--Select--</option>
                            @foreach ($blogCategories as $category)
                                <option value="{{ $category->id }}"
                                        wire:key="category-{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
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
                        selector: 'textarea#Content',
                        plugins: 'image code',
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
  /* enable title field in the Image dialog*/
  image_title: false,

  browser_spellcheck: true,

  paste_block_drop: false,

  paste_data_images: true,

  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
  /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
  file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: (cb, value, meta) => {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.addEventListener('change', (e) => {
      const file = e.target.files[0];

      const reader = new FileReader();
      reader.addEventListener('load', () => {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        const id = 'blobid' + (new Date()).getTime();
        const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        const base64 = reader.result.split(',')[1];
        const blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      });
      reader.readAsDataURL(file);
    });

    input.click();
  },
                        setup: function(editor) {
                                editor.on('change', function(e) {
                                    @this.set('state.Content', editor.getContent(), true);
                                });
                            }
                        })
                    "

                    >
                        <label class="form-label" for="board_textarea">Content</label>
                        <textarea
                            class="form-control @error('Content') is-invalid @enderror"
                            wire:model.defer="state.Content"
                            name="Content"
                            placeholder=""
                            rows="3"
                            id="Content"

                        ></textarea>
                        @error('Content')
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
                        {{ $blogItem && $blogItem->BlogId ? "Update" : 'Add' }} Blog Item
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
