<!-- Modal -->
<div class="modal fade hideableModal createOrUpdateModal" id="ce{{$BlogId}}" tabindex="-1"
     aria-labelledby="ReadBlogCommentModalLabel" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Blog Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if(isset($BlogComments) && !empty($BlogComments))

                <div class="modal-body">
                    <div class="mb-3">
                        @foreach($BlogComments as $BlogComment)
                            <ul>
                                <li>{{ $BlogComment["Content"] }}
                                    <a class="px-1" href="#" title="Delete Comment"
                                       data-bs-toggle="modal"
                                       data-bs-target="#commentdeleteConfirmation{{ $BlogComment["CommentId"] }}Modal"
                                    >
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                    <span style="float: right; color: green">{{$BlogComment["Author"]}}</span>
                                </li>
                            </ul>
                        @endforeach
                    </div>

                </div>
            @else
                @if(!is_null($BlogId))
                    <div class="modal-body">
                        <div class="mb-3">
                            <span>No Comment Exist on This blog</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#addBlogCommentModal"
                                data-bs-toggle="modal" data-bs-dismiss="modal">
                            Add Comment
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
<!-- End Modal -->

{{--Second Modal If Blog Id is Null--}}
<div class="modal fade hideableModal" id="addBlogCommentModal" aria-hidden="true"
     aria-labelledby="addBlogCommentModalLabel" tabindex="-1"  wire:ignore.self>
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="addBlogComment({{ $BlogId }})">
                <div class="modal-body">
                    <div class="ms-auto mb-3">
                        <textarea id="Content" name="Content" wire:model.defer="Content" class="form-control" placeholder="Description"
                                  rows="4"></textarea>
                        @error('Content')
                        <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary px-5">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>

@foreach($BlogComments as $BlogComment)
    <div class="modal fade hideableModal" id="commentdeleteConfirmation{{ $BlogComment["CommentId"] }}Modal"
         tabindex="-1"
         aria-labelledby="commentdeleteConfirmation{{ $BlogComment["CommentId"] }}ModalLabel" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <h6 class="modal-title fs-10 text-white"
                    id="deleteConfirmation{{ $id ?? 0 }}ModalLabel">{{ $title ?? 'Delete!'}}</h6>
                <div class="modal-body text-center">
                    <div>
                        <i class="bi-exclamation rounded-circle p-2 text-primary border-primary"
                           style="width: 90px; height: 90px;font-size: 24px; line-height: 75px;border: 3px solid"></i>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">{!! $title ?? 'Are you sure?'!!}</h4>
                    <p class="fw-500 fs-15">{!! $description ?? 'You would not be able to recover this!' !!}</p>
                    <div class="btn-group my-2">
                        <button type="button"
                                class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                data-bs-dismiss="modal">Cancel
                        </button>
                        <button type="button"
                                class="btn btn-primary fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                wire:click.prevent="deleteComment({{ $BlogComment["CommentId"] }})">
                            <div wire:loading.remove wire:target="deleteComment({{ $BlogComment["CommentId"] }})">
                                Yes,Delete!
                            </div>
                            <div wire:loading wire:target="deleteComment({{ $BlogComment["CommentId"] }})">
                                Deleting...
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach






