<!-- Modal -->
<div class="modal fade hideableModal createOrUpdateModal" tabindex="-1"
     aria-labelledby="createOrUpdateModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg vertical-align-center" role="document">
            <form
                @if($updateMode)
                wire:submit.prevent="updateBlog({{$Blog_Id}})"
                @else
                wire:submit.prevent="createBlog()"
                @endif>
                        <div class="modal-content">
                            <div class="modal-header">
                                @if($updateMode)
                                    <h5 class="modal-title" id="exampleModalLabel">Update Blog</h5>
                                @else
                                    <h5 class="modal-title" id="exampleModalLabel">Create Blog</h5>
                                @endif
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="subject">Subject</label>
                                            <input type="text" name="Subject" wire:model.defer="Subject" id="subject" class="form-control" placeholder="subject">
                                            @error('Subject')
                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="blog">Content</label>
                                            <textarea id="Content" wire:model.defer="Content" class="form-control" placeholder="Content" rows="6"></textarea>
                                            @error('Content')
                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-2 mt-3">

                                        <div
                                            class="mb-2"
                                            x-data="{isFileDropping: false, isUploadingFile: false, uploadingProgress: 0}"
                                            x-on:drop="isFileDropping = false"
                                            x-on:drop.prevent="

                if ($event.dataTransfer.files.length > 0 ) {
                    isUploadingFile = true;
                    var allowedExtensions = /(\/jpg|\/jpeg|\/png|\/gif)$/i;
                    var fileTypeCheck = $event.dataTransfer.files[0].type;
                    if (!allowedExtensions.exec(fileTypeCheck)) {

                        $('.showErrorMsg').addClass('d-block');

                        return;
                     }

                        $('.showErrorMsg').addClass('d-none');

                    @this.upload( 'file', $event.dataTransfer.files[0],
                        (uploadedFilename) => {
                        }, () => {

                        }, (event) => {
                            uploadingProgress = event.detail.progress;
                        });
                }
            "
                                            x-on:dragover.prevent="isFileDropping = true"
                                            x-on:dragleave.prevent="isFileDropping = false"
                                        >
                                            <div id="basicExampleDropzone"
                                                 class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">
                                                <div class="dz-message">
{{--                                                    <h5>Drag and drop your file here</h5>--}}
{{--                                                    <p class="mb-2">or</p>--}}
                                                    <div class="text-center"
                                                         x-on:livewire-upload-start="isUploadingFile = true"
                                                         x-on:livewire-upload-finish=""
                                                         x-on:livewire-upload-error=""
                                                         x-on:livewire-upload-progress="uploadingProgress = $event.detail.progress"
                                                    >
                                                        <input
                                                            id="file_upload"
                                                            type="file"
                                                            name="image"
                                                            hidden="hidden"
                                                            wire:model="BlogImage"
                                                            x-ref="file_upload"
                                                        />
                                                        <button class="btn bg-primary btn-sm text-white" @click.prevent="$refs.file_upload.click()">Upload Image</button>
                                                    </div>
                                                </div>
                                                <div class="col h-100 mt-4" style="display: none" x-show="isUploadingFile">
                                                    <div class="dz-preview dz-file-preview">
                                                        <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"  @click.prevent="$wire.set('BlogImage', null); isUploadingFile = false">
                                                            <small class="bi-x" data-dz-remove></small>
                                                        </a>
                                                        <div class="dz-details d-flex">
                                                            <div class="dz-img flex-shrink-0">
                                                                @if($BlogImage)
                                                                    <img
                                                                        class="img-fluid dz-img-inner" data-dz-thumbnail
                                                                        src="{{ $BlogImage->temporaryUrl() }}"
                                                                    />
                                                                @endif
                                                            </div>

                                                            <div class="dz-file-wrapper flex-grow-1">
                                                                <h6 class="dz-filename">
                                                                    @if($BlogImage)
                                                                        <span class="dz-title" data-dz-name>{{ $BlogImage->getClientOriginalName() }}</span>
                                                                    @endif
                                                                </h6>
                                                                <div class="dz-size" data-dz-size></div>
                                                            </div>
                                                        </div>
                                                        <div class="dz-progress progress">
                                                            <div
                                                                class="dz-upload progress-bar bg-success"
                                                                role="progressbar"
                                                                x-bind:style="'width:' + `${uploadingProgress}%`"
                                                                aria-valuenow="0"
                                                                aria-valuemin="0"
                                                                aria-valuemax="100"
                                                                data-dz-uploadprogress></div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            {{--                            <div class="dz-success-mark  ">--}}
                                                            {{--                                <span class="bi-check-lg"></span>--}}
                                                            {{--                            </div>--}}
                                                            {{--                            <div class="dz-error-mark">--}}
                                                            {{--                                <span class="bi-x-lg"></span>--}}
                                                            {{--                            </div>--}}
                                                            {{--                            <div class="dz-error-message">--}}
                                                            {{--                                <small data-dz-errormessage></small>--}}
                                                            {{--                            </div>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($OldBlogImage && empty($BlogImage))
                                                <div class="col-6 mt-4 mx-auto">
                                                    <div class="dz-preview dz-file-preview">
                                                        <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"  @click.prevent="$wire.set('OldBlogImage', null); isUploadingFile = false">
                                                            <h1 class="bi-x" title="Remove Image" data-dz-remove></h1>
                                                        </a>
                                                        <div class="dz-details d-flex">
                                                            <div class="dz-img flex-shrink-0">
                                                                        <img id="blah" src="{{ Storage::url($OldBlogImage) }}" alt="your image"
                                                                             style="width: 100px; height: 100px; border-radius: 10px"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>


                                            <span class="showErrorMsg fw-semi-bold mt-1"
                                                  style="font-size: 13px !important;color: #ff0000 !important;display: none"> Only jpg,png,giff,tiff are allowed</span>

                                        </div>
                                        @error('BlogImage')
                                        <span class="text-danger fw-semi-bold"
                                              style="font-size: 13px !important; ">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                @if($updateMode)
                                    <button type="submit" class="btn btn-primary px-5">Update</button>
                                @else
                                    <button type="submit" class="btn btn-primary px-5">Save</button>
                                @endif
                            </div>
                        </div>
            </form>
    </div>
</div>
<!-- End Modal -->

@pushonce('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type='text/javascript'>
    $(".clickToUploadImage").click(function () {
        $(".hiddenUploadImage").click();
        console.log("Nadeem");
    });
</script>
{{--    <script>--}}
{{--        var imageId = document.getElementById('imgInp');--}}
{{--        imageId.onchange = evt => {--}}
{{--            const [file] = imgInp.files--}}
{{--            if (file) {--}}
{{--                blah.src = URL.createObjectURL(file)--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
@endpushonce

