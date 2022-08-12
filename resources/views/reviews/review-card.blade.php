<div class="card">
    <div class="card-body">
        <form wire:submit.prevent="saveRatingForm" method="post" class="row">
            <div class="mt-4 col-12">
               <div>
                   <div class="rate">
                       <input type="radio" id="star5" wire:model.defer="state.rating" name="rating" value="5"/>
                       <label for="star5" title="text">5 stars</label>
                       <input type="radio" id="star4" wire:model.defer="state.rating" name="rating" value="4"/>
                       <label for="star4" title="text">4 stars</label>
                       <input type="radio" id="star3" wire:model.defer="state.rating" name="rating" value="3"/>
                       <label for="star3" title="text">3 stars</label>
                       <input type="radio" id="star2" wire:model.defer="state.rating" name="rating" value="2"/>
                       <label for="star2" title="text">2 stars</label>
                       <input type="radio" id="star1" wire:model.defer="state.rating" name="rating" value="1"/>
                       <label for="star1" title="text">1 star</label>
                   </div>
               </div>

            </div>
            <p>  @error('rating')
                <span class="invalid-feedback d-block">{{$message}}</span>
                @enderror</p>

            <div class="flex-grow-1 col-12">
                <div class="border">
                    <textarea id="remarks" name="remarks"
                              wire:model.defer="state.remarks"
                              class="form-control"
                              placeholder="Description"
                              rows="4">
                    </textarea>
                </div>
                <div class="text-start text-lg-end py-3 px-3" style="background-color: #2D394C10">
                    <button class="btn btn-secondary px-5" type="submit" style="background-color: #2D394C">Post</button>
                </div>
            </div>
        </form>
    </div>
</div>
