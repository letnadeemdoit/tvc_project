<div id="enableVacationMaxLength" class="card">
    @if(!$user->is_super_admin)
        <div class="card-header">
            <h4 class="card-title">Vacation Length</h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Form -->
            <form wire:submit.prevent="enableVacationMaxLength">
                @if($user->is_admin)
                    <label class="row form-check form-switch mb-4" for="enable_max_vacation_length">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="d-block text-dark mb-1">Enable Vacation Length.</span>
                              <span class="d-block fs-5 text-muted">
                                  Use this option to enable Vacation Max Length.
                              </span>
                            </span>
                        <span class="col-4 col-sm-3 text-end">
                              <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="enable_max_vacation_length"
                                  name="enable_max_vacation_length"
                                  wire:model.defer="state.enable_max_vacation_length"
                                  wire:change="scheduleMaxVacationLength(@this.get('state.enable_max_vacation_length') === 1 ? 0 : 1)"
                                  value="1"
                              />
                            </span>
                    </label>
                    @if(isset($state['enable_max_vacation_length']) && $state['enable_max_vacation_length'] === 1)
                        <div class="row mb-4" id="showEnableVacationLength">
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label
                                        class="form-label"
                                        for="vacation_length"
                                    >Vacation Length:</label>
                                    <input
                                        type="number"
                                        class="form-control @error('vacation_length') is-invalid @enderror"
                                        name="vacation_length"
                                        id="vacation_length"
                                        placeholder="Vacation Length"
                                        wire:model.defer="state.vacation_length"
                                    />
                                    @error('vacation_length')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif

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
