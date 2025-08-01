<div>
   <div class="row mb-5">
    <div class="col-12 col-lg-6">
        <div class="d-flex justify-content-between">
            <h4>{{$totalComments}} comments</h4>
            <div><label for="">Sort By</label>
                <select name="" id="" wire:model.defer="type" wire:change="changeType" class="btn btn-outline-secondary border px-3 py-1 rounded" style="">
                    <option value="Newest" >Newest</option>
                    <option value="Oldest">Oldest</option>
                </select>
            </div>
        </div>
    </div>
</div>
   <div class="row my-5">
      <div class="col-12 col-lg-6">
          <div class="d-flex">
              <div class="flex-shrink-0">
            <img src="{{auth()->user()->profile_photo_url}}"
                 class="avatar-initials img-fluid position-relative rounded-circle"
                 alt="..."
                 style="width:50px !important;height:50px !important;object-fit: cover !important;"
            >
        </div>
              <div class="flex-grow-1 ms-3">
                  <form wire:submit.prevent="addBlogComment()">
                      <div class="border">
                    <textarea id="Content" name="Content"
                      wire:model.defer="state.Content"
                      class="form-control @error('Content') is-invalid @enderror"
                      placeholder="Add comment here.."
                      rows="4">
                    </textarea>
                    @error('Content')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                      <div class="text-start text-lg-end py-3 px-3" style="background-color: #2D394C10">
                    <button class="btn btn-secondary px-5" style="background-color: #2D394C">Post</button>
                </div>
                  </form>
              </div>
         </div>

          <div class="row">
              @foreach($BlogComments as $comment)
                  <div class="col-10">
                      <div class="d-flex w-100 mt-3">
                          <div class="flex-shrink-0">
                              <img src="{{$comment->user->profile_photo_url}}"
                                   class="avatar-initials img-fluid position-relative rounded-circle"
                                   alt="..."
                                   style="width:50px !important;height:50px !important;object-fit: cover !important;"
                              >
                          </div>
                          <div class="flex-grow-1 ms-3 mt-2">
                              <h5 class="mb-0">{{$comment->user->first_name}} {{$comment->user->last_name}}</h5>
                              <p class="mb-0" style="font-size: 12px">{!! $comment->message !!}</p>
                          </div>
                      </div>
                  </div>

                  @if(auth()->user()->is_admin)
                      <div class="col-2">
                          <div class="d-flex w-100 mt-4">
                              <a class="btn btn-ghost-danger" title="Delete Comment" href="#"
                                 wire:click.prevent="deleteBlogComment({{$comment->id}})"
                              >
                                  <i class="bi-trash"></i>
                              </a>
                          </div>
                      </div>
                  @endif
              @endforeach
          </div>
      </div>
   </div>
    @if($isMoreComments)
        <div class="row mt-5 mb-3">
            <div class="col-12 col-lg-6">
                <button class="w-100 btn btn-primary" wire:click="moreComment()">Load More {{$remainingComments}} comments</button>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>

        const myTimeout = setTimeout(updateComment, 5000);

        function updateComment() {
            var cms = document.getElementsByClassName('_50f7')[0].textContent;
            console.log(cms);
            document.getElementById("content").innerHTML = cms;
        }
    </script>
@endpush
