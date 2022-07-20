<!-- Modal -->
<div class="modal fade" id="createOrUpdateBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form wire:submit.prevent="createBlog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="author">Author</label>
                            <input type="text" wire:model="state.Author" id="author" class="form-control" placeholder="Author">
                            @error('Author') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="subject">Author</label>
                            <input type="text" wire:model="state.Subject" id="subject" class="form-control" placeholder="Subject">
                            @error('Subject') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="blog">Blog Description</label>
                            <textarea id="Content" wire:model="state.Content" class="form-control" placeholder="Blog Description" rows="4"></textarea>
                            @error('Content') <span class="error">{{ $message }}</span> @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary px-5">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal -->

