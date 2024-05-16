<div id="enableOverlappingVacations" class="card">
    @if(!$user->is_super_admin)
        <div class="card-header">
            <h4 class="card-title">Allow overlapping vacations</h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Form -->
            <form wire:submit.prevent="enableOverlappingVacations">
                @if($user->is_admin)
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="allow_all_vacations_to_overlap" class="form-label">Allow all vacations to overlap:</label>
                                <div class="form-check">
                                    <input
                                        class="form-check-input border-primary"
                                        style="width: 20px;height: 20px"
                                        type="checkbox"
                                        value="1"
                                        id="allow_all_vacations_to_overlap"
                                        {{ $state['overlap_vacation'] === 'all vacations' ? 'checked' : '' }}
                                        wire:change.prevent="allowOverlapVacation('all vacations')"
                                        wire:loading.attr="disabled"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="allow_unapproved_vacations_to_overlap" class="form-label">Allow unapproved vacations to overlap:</label>
                                <div class="form-check">
                                    <input
                                        class="form-check-input border-primary"
                                        style="width: 20px;height: 20px"
                                        type="checkbox"
                                        value="1"
                                        id="allow_unapproved_vacations_to_overlap"
                                        {{ $state['overlap_vacation'] === 'unapproved vacations' ? 'checked' : '' }}
                                        wire:change.prevent="allowOverlapVacation('unapproved vacations')"
                                        wire:loading.attr="disabled"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="do_not_allow_overlapping_vacations" class="form-label">Do not allow overlapping vacations:</label>
                                <div class="form-check">
                                    <input
                                        class="form-check-input border-primary"
                                        style="width: 20px;height: 20px"
                                        type="checkbox"
                                        value="1"
                                        id="do_not_allow_overlapping_vacations"
                                        {{ $state['overlap_vacation'] === 'no' ? 'checked' : '' }}
                                        wire:change.prevent="allowOverlapVacation('no')"
                                        wire:loading.attr="disabled"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                <div class="d-flex align-items-center justify-content-end">
                    <x-jet-action-message class="text-success me-2" on="saved"/>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
            <!-- End Form -->
        </div>
        <!-- End Body -->
    @endif



</div>
