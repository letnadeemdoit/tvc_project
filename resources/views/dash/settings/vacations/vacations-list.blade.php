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
                            aria-label="Search vacations by name"
                            wire:model.debounce.500ms="search"
                        />
                    </div>
                    <!-- End Search -->
                </form>
            </div>
            <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                <!-- End Datatable Info -->
                @if($user->is_owner && !$user->is_owner_only)
                    <div class="dropdown">
                        <button type="button" class="btn btn-white btn-sm dropdown-toggle w-100"
                                id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-people-fill me-2"></i>
                            Owner: {{ $this->owner ? optional(\App\Models\User::where('user_id', $this->owner)->where('HouseId', $this->user->HouseId)->first())->name : 'You' }}
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown" style="">
                            <span class="dropdown-header">You</span>
                            <a id="you{{ $user->user_id }}" class="dropdown-item {{ $this->owner ?: 'active' }}"
                               href="#" wire:click.prevent="$set('owner', null)">
                                <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ $user->profile_photo_url }}"
                                     alt="{{ $user->name }}">
                                {{ $user->name }}
                            </a>
                            <span class="dropdown-header">Owners</span>
                            @foreach($this->owners as $owner)
                                <a id="owner{{ $owner->user_id }}"
                                   class="dropdown-item {{ $this->owner === $owner->user_id ? 'active' : '' }}" href="#"
                                   wire:click.prevent="$set('owner', {{ $owner->user_id }})">
                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ $owner->profile_photo_url }}"
                                         alt="{{ $owner->name }}">
                                    {{ $owner->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control form-control-sm"
                        name="datetimes"
                        style="min-width: 200px"
                        readonly
                    />
                </div>
                @if($user->is_admin)
                    <div class="dropdown ms-1">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenuProperties"
                                data-bs-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            Properties: {{ $properties ? 'Customized' : 'All'  }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuProperties">
                            <a href="#" class="dropdown-item {{ $properties === null || count($selectedHouses) === $this->houses->count()? 'active' : '' }}" wire:click.prevent="setProperty()">All</a>
                            @foreach($this->houses as $house)
                                <div class="dropdown-item {{ in_array($house->HouseID, $selectedHouses) ? 'active' : '' }}">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            id="house{{ $house->HouseID }}"
                                            class="form-check-input"
                                            wire:model.defer="selectedHouses"
                                            wire:change.prevent="setProperty({{ $house->HouseID }})"
                                            value="{{ $house->HouseID }}"
                                        />
                                        <label class="form-check-label" for="house{{ $house->HouseID }}">{{ $house->HouseName }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
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
                    <th>Schedule Dates</th>
                    <th>Repeat</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data as $dt)
                    <tr>
                        <td style="width: 100px">{{$dt->VacationName}}</td>
                        <td>{{ $dt->house ? $dt->house->HouseName : '' }}</td>
                        <td>{{ $dt->owner ? $dt->owner->name : '-' }}</td>
                        <td>{{ $dt->scheduled_dates }}</td>
                        <td class="text-capitalize">{{ $dt->recurrence ?: 'none' }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-white" href="#"
                                   wire:click.prevent="$emit('showVacationScheduleModal', true, {{$dt->VacationId}})"
                                >
                                    <i class="bi-pencil me-1 text-success"></i> Edit
                                </a>
                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm"
                                    wire:click.prevent="destroy({{ $dt->VacationId }})"
                                >
                                    <i class="bi-trash"></i>
                                </button>

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
                $('input[name="datetimes"]').daterangepicker({
                    opens: 'left',
                    // timePicker: true,
                    startDate: '{{ $from }}',
                    endDate: '{{ $to }}',
                    locale: {
                        format: 'DD/MM/YYYY'
                    }
                });

                $('input[name="datetimes"]').on('apply.daterangepicker', function (ev, picker) {
                    @this.
                    set('from', picker.startDate.format('DD-MM-YYYY'));
                    @this.
                    set('to', picker.endDate.format('DD-MM-YYYY'));
                });
            });
        </script>
    @endpush
</div>
