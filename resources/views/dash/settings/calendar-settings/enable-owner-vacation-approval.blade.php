<div id="enableOwnerVacationApproval" class="card">
    @if(!$user->is_super_admin)
        <div class="card-header">
            <h4 class="card-title">Scheduler vacations</h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Form -->
            <form wire:submit.prevent="enableOwnerVacationApproval">
                @if($user->is_admin)
                    <!-- Form Switch -->
                    <label class="row form-check form-switch mb-4" for="calendar_height">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="d-block text-dark mb-1">Scheduler vacations approval</span>
                              <span class="d-block fs-5 text-muted">
                                  Use this option to enable Scheduler vacations approval by Admin.
                              </span>
                            </span>
                        <span class="col-4 col-sm-3 text-end">
                              <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="owner_vacation_approval"
                                  name="owner_vacation_approval"
                                  wire:model.defer="state.owner_vacation_approval"
                                  value="1"
                              />
                            </span>
                    </label>
                    <!-- End Form Switch -->
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
