<div>
    @push('stylesheets')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    @endpush
    <div class="card">
        <!-- Header -->
        <div class="card-header card-header-content-md-between">
            <div class="mb-2 mb-md-0 w-lg-50">
                <form>
                    <!-- Search -->
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text">
                            <div wire:loading wire:target="search">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <i class="bi-search" wire:loading.remove wire:target="search"></i>
                        </div>
                        <input
                            id="datatableSearch"
                            type="search"
                            class="form-control"
                            placeholder="Search by name"
                            aria-label="Search boards"
                            wire:model.debounce.500ms="search"
                        />
                    </div>
                    <!-- End Search -->
                </form>
            </div>
            <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                <div class="form-group">
                    <button
                        type="button"
                        class="btn btn-primary btn-sm"
                        wire:click="toggleVacations"
                        wire:loading.attr="disabled"
                    >
                        Show {{ $vacations === 'approved' ? 'Unapproved' : 'Approved' }}
                    </button>
                </div>
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        name="approval_date_times"
                        style="min-width: 200px"
                        readonly
                    />
                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <table
                class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                <tr>
                    <th style="width: 100px">Name</th>
                    <th>House Name</th>
                    <th>Created By</th>
                    <th>Role</th>
                    <th>Schedule Dates</th>
                    <th>Approve/Un Approve</th>
                </tr>
                </thead>

                <tbody>

                @foreach($data as $dt)
                    <tr>
                        <td style="width: 100px">{{$dt->VacationName}}</td>
                        <td>{{ $dt->house ? $dt->house->HouseName : '' }}</td>
                        <td>{{ $dt->owner ? $dt->owner->name : '-' }}</td>
                        <td>{{ $dt->owner->role }}</td>
                        <td>{{ $dt->scheduled_dates }}</td>
                        <td x-data="" class="" style="width: 120px">
                            <div class="form-check">
                                <input
                                    class="form-check-input border-primary"
                                    style="width: 20px;height: 20px"
                                    type="checkbox"
                                    value="1"
                                    id="enable_or_disable_{{$dt->VacationId}}"
                                    {{ $dt->is_vac_approved ? 'checked' : '' }}
                                    @change.debounce="@this.isVacApproved({{$dt->is_vac_approved ? 0 : 1}}, {{ $dt->VacationId }})"
                                    wire:loading.attr="disabled"
                                />
                                <label class="form-check-label" for="enable_or_disable_{{$dt->VacationId}}">
                                    <x-jet-action-message on="saved-{{$dt->VacationId}}" class="text-success" />
                                </label>
                            </div>
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer py-2">
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <span class="me-2">Per Page:</span>
                        <!-- Select -->
                        <div class="tom-select-custom">
                            <select
                                id="datatableEntries"
                                class="js-select form-select form-select-borderless w-auto"
                                autocomplete="off"
                                data-hs-tom-select-options='{
                                    "searchInDropdown": false,
                                    "hideSearch": true
                                 }'
                                wire:model="per_page"
                            >
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <!-- End Select -->

                        <span class="text-secondary me-2">{{ $data->currentPage() }}</span>
                        <span class="text-secondary me-2">of</span>

                        <!-- Pagination Quantity -->
                        <span id="datatableWithPaginationInfoTotalQty">{{ $data->lastPage() }}</span>
                    </div>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto pt-2">
                    <div
                        class="d-flex align-items-center justify-content-center justify-content-sm-end pagination-disable-button">
                        <!-- Pagination -->
                        {{ $data->onEachSide(0)->links() }}
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Footer -->
    </div>


    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            $(function () {
                $('input[name="approval_date_times"]').daterangepicker({
                    opens: 'left',
                    // timePicker: true,
                    startDate: '{{ \Carbon\Carbon::parse($from)->format('m/d/Y') }}',
                    endDate: '{{ \Carbon\Carbon::parse($to)->format('m/d/Y') }}',
                    locale: {
                        format: 'MM/DD/YYYY'
                    }
                });

                $('input[name="approval_date_times"]').on('apply.daterangepicker', function (ev, picker) {
                @this.set('from', picker.startDate.format('DD-MM-YYYY'));
                @this.set('to', picker.endDate.format('DD-MM-YYYY'));
                });

                Livewire.on('updateUrl', params => {
                    const url = new URL(window.location);
                    Object.keys(params).forEach(key => url.searchParams.set(key, params[key]));
                    window.history.pushState({}, '', url);
                });

            });
        </script>
    @endpush
</div>
