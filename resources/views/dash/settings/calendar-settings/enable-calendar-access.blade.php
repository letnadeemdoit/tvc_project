<div id="enableCalendarAccess" class="card">
    @if(!$user->is_super_admin)
        <div class="card-header">
            <h4 class="card-title">Allow Calendar Access</h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Form -->
            <form wire:submit.prevent="enableCalendarAccessToUsers">
                @if($user->is_admin)
                    <!-- Form Switch -->
                    <label class="row form-check form-switch mb-4" for="enable_calendar_access">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="d-block text-dark mb-1">Allow Calendar Access.</span>
                              <span class="d-block fs-5 text-muted">
                                  Use this option to allow calendar access outside the scheduling window.
                              </span>
                            </span>
                        <span class="col-4 col-sm-3 text-end">
                              <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="enable_calendar_access"
                                  name="enable_calendar_access"
                                  wire:model.defer="state.enable_calendar_access"
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
