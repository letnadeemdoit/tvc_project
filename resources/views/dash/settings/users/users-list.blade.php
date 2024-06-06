<div>
    <!-- Stats -->
{{--    <div class="row">--}}
{{--        <div class="col-sm-12 col-lg-3 mb-3 mb-lg-5">--}}
{{--            <!-- Card -->--}}
{{--            <div class="card h-100">--}}
{{--                <div class="card-body">--}}
{{--                    <h6 class="card-subtitle mb-2">Total users</h6>--}}

{{--                    <div class="row align-items-center gx-2">--}}
{{--                        <div class="col">--}}
{{--                            <span class="js-counter display-4 text-dark">24</span>--}}
{{--                            <span class="text-body fs-5 ms-1">from 22</span>--}}
{{--                        </div>--}}
{{--                        <!-- End Col -->--}}

{{--                        <div class="col-auto">--}}
{{--                  <span class="badge bg-soft-success text-success p-1">--}}
{{--                    <i class="bi-graph-up"></i> 5.0%--}}
{{--                  </span>--}}
{{--                        </div>--}}
{{--                        <!-- End Col -->--}}
{{--                    </div>--}}
{{--                    <!-- End Row -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}
{{--        </div>--}}

{{--        <div class="col-sm-12 col-lg-3 mb-3 mb-lg-5">--}}
{{--            <!-- Card -->--}}
{{--            <div class="card h-100">--}}
{{--                <div class="card-body">--}}
{{--                    <h6 class="card-subtitle mb-2">Active members</h6>--}}

{{--                    <div class="row align-items-center gx-2">--}}
{{--                        <div class="col">--}}
{{--                            <span class="js-counter display-4 text-dark">12</span>--}}
{{--                            <span class="text-body fs-5 ms-1">from 11</span>--}}
{{--                        </div>--}}

{{--                        <div class="col-auto">--}}
{{--                  <span class="badge bg-soft-success text-success p-1">--}}
{{--                    <i class="bi-graph-up"></i> 1.2%--}}
{{--                  </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- End Row -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}
{{--        </div>--}}

{{--        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">--}}
{{--            <!-- Card -->--}}
{{--            <div class="card h-100">--}}
{{--                <div class="card-body">--}}
{{--                    <h6 class="card-subtitle mb-2">New/returning</h6>--}}

{{--                    <div class="row align-items-center gx-2">--}}
{{--                        <div class="col">--}}
{{--                            <span class="js-counter display-4 text-dark">56</span>--}}
{{--                            <span class="display-4 text-dark">%</span>--}}
{{--                            <span class="text-body fs-5 ms-1">from 48.7</span>--}}
{{--                        </div>--}}

{{--                        <div class="col-auto">--}}
{{--                  <span class="badge bg-soft-danger text-danger p-1">--}}
{{--                    <i class="bi-graph-down"></i> 2.8%--}}
{{--                  </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- End Row -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}
{{--        </div>--}}

{{--        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">--}}
{{--            <!-- Card -->--}}
{{--            <div class="card h-100">--}}
{{--                <div class="card-body">--}}
{{--                    <h6 class="card-subtitle mb-2">Active members</h6>--}}

{{--                    <div class="row align-items-center gx-2">--}}
{{--                        <div class="col">--}}
{{--                            <span class="js-counter display-4 text-dark">28.6</span>--}}
{{--                            <span class="display-4 text-dark">%</span>--}}
{{--                            <span class="text-body fs-5 ms-1">from 28.6%</span>--}}
{{--                        </div>--}}

{{--                        <div class="col-auto">--}}
{{--                            <span class="badge bg-soft-secondary text-secondary p-1">0.0%</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- End Row -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- End Stats -->

    <!-- Card -->
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
                            placeholder="Search by username"
                            aria-label="Search users"
                            wire:model.debounce.500ms="search"
                        />
                    </div>
                    <!-- End Search -->
                </form>
            </div>
        </div>
        <!-- End Header -->
        <x-jet-banner />
        <!-- Table -->
        <div class="table-responsive datatable-custom position-relative">
            <table
                id="datatable"
                class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
            >
                <thead class="thead-light">
                <tr>
                    {{--                    <th class="table-column-pe-0">--}}
                    {{--                        <div class="form-check">--}}
                    {{--                            <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">--}}
                    {{--                            <label class="form-check-label" for="datatableCheckAll"></label>--}}
                    {{--                        </div>--}}
                    {{--                    </th>--}}
                    <th>Username</th>
                    <th>Full name</th>
                    <th>Role</th>
                    <th style="width: 120px">Enabled</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data as $dt)
                    <tr>
                        {{--                        <td class="table-column-pe-0">--}}
                        {{--                            <div class="form-check">--}}
                        {{--                                <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll1">--}}
                        {{--                                <label class="form-check-label" for="datatableCheckAll1"></label>--}}
                        {{--                            </div>--}}
                        {{--                        </td>--}}
                        <td>
                            <a class="d-flex align-items-center" href="#!">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img" src="{{ $dt->profile_photo_url }}"

                                         alt="user">
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">{{ $dt->user_name }}</span>
                                    <span class="d-block fs-5 text-body">{{ $dt->email ??  '' }}</span>
                                </div>
                            </a>
                        </td>
                        <td>
                            <span class="d-block mb-0">{{ $dt->name }}</span>
                        </td>
                        <td>{{ $dt->role === 'Owner' ? 'Scheduler' : $dt->role }}</td>
                        <td x-data="" class="" style="width: 120px">
                            <div class="form-check">
                                <input
                                    class="form-check-input border-primary"
                                    style="width: 20px;height: 20px"
                                    type="checkbox"
                                    value="1"
                                    id="enable_or_disable_{{$dt->user_id}}"
                                    {{ $dt->is_confirmed ? 'checked' : '' }}
                                    @change.debounce="@this.isConfirmed({{$dt->is_confirmed ? 0 : 1}}, {{ $dt->user_id }})"
                                    wire:loading.attr="disabled"
                                />
                                <label class="form-check-label" for="enable_or_disable_{{$dt->user_id}}">
                                    <x-jet-action-message on="saved-{{$dt->user_id}}" class="text-success" />
                                </label>
                            </div>
                        </td>


                        <td class="text-end">
                            <div class="btn-group" role="group" aria-label="Edit group">

{{--                                @if(isset($dt->role) && $dt->role == 'Guest')--}}
                                @if($dt->role === \App\Models\User::ROLE_GUEST)


                                @else
                                    <a class="btn btn-white" href="#!"
                                       wire:click.prevent="$emit('showSendCredentialsUserCUModal', true, {{ $dt->user_id}})"
                                    >
                                        <i class="bi-envelope me-1 text-success"></i> Send Mail
                                    </a>
                                @endif

                                @can('update', $dt)
                                    <a class="btn btn-white" href="#"
                                       wire:click.prevent="$emit('showUserCUModal', true, {{ $dt->user_id}})"
                                    >
                                        <i class="bi-pencil me-1 text-success"></i> Edit
                                    </a>
                                @endcan

                                @can('delete', $dt)
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm"
                                        wire:click.prevent="destroy({{$dt->user_id}})"
                                    >
                                        <i class="bi-trash"></i>
                                    </button>
                                @endcan

                            </div>
                        </td>



{{--                        <td>--}}
{{--                            @can('update', $dt)--}}
{{--                                <button--}}
{{--                                    type="button"--}}
{{--                                    class="btn btn-white btn-sm"--}}
{{--                                    wire:click.prevent="$emit('showUserCUModal', true, {{ $dt->user_id}})"--}}
{{--                                >--}}
{{--                                    <i class="bi-pencil-fill"></i>--}}
{{--                                </button>--}}
{{--                            @endcan--}}
{{--                            @can('delete', $dt)--}}
{{--                                <button--}}
{{--                                    type="button"--}}
{{--                                    class="btn btn-danger btn-sm trash-btn"--}}
{{--                                    wire:click.prevent="destroy({{$dt->user_id}})"--}}
{{--                                >--}}
{{--                                    <i class="bi-trash"></i>--}}
{{--                                </button>--}}
{{--                            @endcan--}}
{{--                        </td>--}}
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
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-end pagination-disable-button">
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
    <!-- End Card -->
</div>
