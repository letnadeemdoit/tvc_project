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
                                <div class="col-md-6">
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
                                        <div  id="basicExampleDropzone" style="margin: 0"
                                              class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light">
                                            <div class="dz-message">

                                                <h5>Drag and drop your file here</h5>

                                                <p class="mb-2">or</p>


                                                <a href="#" class="clickToUploadImage">
                                                    <span class="btn bg-primary btn-sm text-white">Upload Image</span>
                                                </a>
                                                <input type="file"
                                                       class="form-control hiddenUploadImage file-upload"
                                                       name="BlogImage" wire:model="BlogImage" id="BlogImage" accept=".jpeg,.jpg,.png,.gif"
                                                       style="display: none">
                                                <div class="mt-3">
                                                    @if($BlogImage || $OldBlogImage)
                                                        @if($BlogImage)
                                                            <img id="blah" src="{{ $BlogImage->temporaryUrl() }}" alt="your image"
                                                                 style="width: 100px; height: 100px; border-radius: 10px"/>
                                                        @elseif($OldBlogImage)
                                                            <img id="blah" src="{{ Storage::url($OldBlogImage) }}" alt="your image"
                                                                 style="width: 100px; height: 100px; border-radius: 10px"/>
                                                        @else
                                                            <img id="blah" src="" alt="your image"
                                                                 style="width: 100px; height: 100px; border-radius: 10px"/>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @error('BlogImage')
                                        <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
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

