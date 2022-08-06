<div id="preferencesSection" class="card">
    <div class="card-header">
        <h4 class="card-title">Preferences</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <!-- Form -->
        <form wire:submit.prevent="updatePreferences">
            <!-- Form -->
            {{--            <div class="row mb-4">--}}
            {{--                <label for="languageLabel" class="col-sm-3 col-form-label form-label">Language</label>--}}

            {{--                <div class="col-sm-9">--}}
            {{--                    <!-- Select -->--}}
            {{--                    <div class="tom-select-custom">--}}
            {{--                        <select class="js-select form-select" id="languageLabel" data-hs-tom-select-options='{--}}
            {{--                                  "searchInDropdown": false--}}
            {{--                                }'>--}}
            {{--                            <option label="empty"></option>--}}
            {{--                            <option value="language1" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="Image description" width="16"/><span>English (US)</span></span>'>English (US)</option>--}}
            {{--                            <option value="language2" selected data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Image description" width="16"/><span>English (UK)</span></span>'>English (UK)</option>--}}
            {{--                            <option value="language3" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/de.svg" alt="Image description" width="16"/><span>Deutsch</span></span>'>Deutsch</option>--}}
            {{--                            <option value="language4" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/dk.svg" alt="Image description" width="16"/><span>Dansk</span></span>'>Dansk</option>--}}
            {{--                            <option value="language5" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/es.svg" alt="Image description" width="16"/><span>Español</span></span>'>Español</option>--}}
            {{--                            <option value="language6" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/nl.svg" alt="Image description" width="16"/><span>Nederlands</span></span>'>Nederlands</option>--}}
            {{--                            <option value="language7" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/it.svg" alt="Image description" width="16"/><span>Italiano</span></span>'>Italiano</option>--}}
            {{--                            <option value="language8" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/cn.svg" alt="Image description" width="16"/><span>中文 (繁體)</span></span>'>中文 (繁體)</option>--}}
            {{--                        </select>--}}
            {{--                    </div>--}}
            {{--                    <!-- End Select -->--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <!-- End Form -->

            <!-- Form -->
            {{--            <div class="row mb-4">--}}
            {{--                <label for="timeZoneLabel" class="col-sm-3 col-form-label form-label">Time zone</label>--}}

            {{--                <div class="col-sm-9">--}}
            {{--                    <input type="text" class="form-control" name="currentPassword" id="timeZoneLabel" placeholder="Your time zone" aria-label="Your time zone" value="GMT+01:00" readonly>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <!-- End Form -->

            <!-- Form Switch -->
            <label class="row form-check form-switch mb-4" for="show_old_save">
                    <span class="col-8 col-sm-9 ms-0">
                      <span class="d-block text-dark">Show additional schedule vacations screen</span>
                      <span class="d-block fs-5">
                          Use this option to control whether you prefer to update the calendar by clicking on the day or by scheduling on the separate vacations screen. Using just the calendar is a lot easier, however, if you are using an older browser this functionality may not work to your liking.
                      </span>
                    </span>
                    <span class="col-4 col-sm-3 text-end">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            name="show_additional_schedule_vacations_screen"
                            wire:model.defer="state.show_additional_schedule_vacations_screen"
                            id="show_old_save"
                            value="1"
                        />
                    </span>
            </label>
            <!-- End Form Switch -->

            <!-- Form Switch -->
            <label class="row form-check form-switch mb-4" for="admin_owner">
                    <span class="col-8 col-sm-9 ms-0">
                      <span class="d-block text-dark mb-1">Allow administrator to have Owner permissions</span>
                      <span class="d-block fs-5 text-muted">
                          Use this option to control whether the admin will also have the ability to schedule vacations. The only reason not do this is in the case that a vacation home has a person who is purely the administrator and doesn't schedule time using the vacation home.
                      </span>
                    </span>
                <span class="col-4 col-sm-3 text-end">
                      <input
                          type="checkbox"
                          class="form-check-input"
                          id="admin_owner"
                          name="allow_administrator_to_have_owner_permissions"
                          wire:model.defer="state.allow_administrator_to_have_owner_permissions"
                          value="1"
                      />
                    </span>
            </label>
            <!-- End Form Switch -->

            <div class="d-flex align-items-center justify-content-end">
                <x-jet-action-message class="text-success me-2" on="saved"/>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
        <!-- End Form -->
    </div>
    <!-- End Body -->
</div>
