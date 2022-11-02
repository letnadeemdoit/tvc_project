<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1 ms-3">
                <form wire:submit.prevent="saveComment" method="post">
                    <div class="border">
                       <textarea id="message" name="message"
                         wire:model.defer="state.message"
                         class="form-control @error('message') is-invalid @enderror"
                         placeholder="Message"
                         rows="7">
                       </textarea>
                        @error('message')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="text-start text-lg-end py-3 px-3" style="background-color: #2D394C10">
                        <button class="btn btn-secondary px-5" type="submit" style="background-color: #2D394C">Submit Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

