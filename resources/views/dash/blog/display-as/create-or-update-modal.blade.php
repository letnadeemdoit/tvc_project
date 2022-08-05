<!-- Modal -->
<div class="modal fade hideableModal createOrUpdateModal" tabindex="-1"
     aria-labelledby="createOrUpdateModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
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

