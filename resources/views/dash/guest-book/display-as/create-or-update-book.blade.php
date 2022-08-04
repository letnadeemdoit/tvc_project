<div class="modal fade hideableModal createOrUpdateModal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="addOrEditGuestBookModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if($updateMode)<h5 class="modal-title" id="staticBackdropLabel">Update Book</h5>
                @else
                    <h5 class="modal-title" id="staticBackdropLabel">Create Book</h5>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form
                    @if($updateMode)
                    wire:submit.prevent="updateGuestBook({{$bookId}})"
                    @else
                    wire:submit.prevent="addGuestBook()"
                    @endif>
                    <legend class="scheduler-border">Book Details</legend>
                    @if($updateMode)
                        <input type="hidden" name="title" wire:model.defer="bookId" id="bookId" class="form-control">
                @endif
                <!-- Form -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mt-3">
                                <fieldset class="border-light scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0">Title*</legend>
                                    <input type="text" name="title" wire:model.defer="title" id="title"
                                           class="form-control" placeholder="title">
                                </fieldset>
                                @error('title')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="mt-3">
                                <fieldset class="border-light scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0">Name</legend>
                                    <input type="text" name="name" wire:model.defer="name" id="title"
                                           class="form-control" placeholder="name">
                                </fieldset>
                                @error('name')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-3">
                                <fieldset class="border-light scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0">Content</legend>
                                    <textarea id="content" wire:model.defer="content" class="form-control"
                                              placeholder="Content" rows="6"></textarea>
                                </fieldset>
                                @error('content')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
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
                                          name="image" wire:model="image" id="image" accept=".jpeg,.jpg,.png,.gif"
                                          style="display: none">
                                   <div class="mt-3">
                                       @if($image || $oldImage)
                                           @if($image)
                                           <img id="blah" src="{{ $image->temporaryUrl() }}" alt="your image"
                                                style="width: 100px; height: 100px; border-radius: 10px"/>
                                           @else
                                               <img id="blah" src="{{ Storage::url($oldImage) }}" alt="your image"
                                                    style="width: 100px; height: 100px; border-radius: 10px"/>
                                           @endif
                                       @endif
                                   </div>
                               </div>
                           </div>
                           @error('image')
                           <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                           @enderror
                       </div>
                       <div class="col-md-12 text-center mt-3">
                           @if($updateMode)
                               <button class="btn btn-dark-secondary text-white w-100" type="submit">Update Guest Book
                               </button>
                           @else
                               <button class="btn btn-dark-secondary text-white w-100" type="submit">Create Guest Book
                               </button>
                           @endif

                       </div>
                   </div>
                    <!-- End Form -->
                    <!-- second fieldset -->
                </form>
            </div>
        </div>
    </div>
</div>

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
