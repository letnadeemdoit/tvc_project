<!-- Modal -->
<div class="modal fade hideableModal createOrUpdateModal" tabindex="-1"
     aria-labelledby="addOrEditBoardModalLabel" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form
            @if($updateMode)
            wire:submit.prevent="updateBulletin({{$HouseId}})"
            @else
            wire:submit.prevent="createBulletin()"
            @endif
            >
            <div class="modal-content">
                <div class="modal-header">
                    @if($updateMode)
                        <h5 class="modal-title" id="exampleModalLabel">Update Description</h5>
                    @else
                        <h5 class="modal-title" id="exampleModalLabel">Add New Description</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <textarea id="Board" name="Board" wire:model="Board" class="form-control" placeholder="Description" rows="10"></textarea>
                                @error('Board')
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


