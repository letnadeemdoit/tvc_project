<div>
    <!-- Card -->
    <div class="card">
        <!-- Header -->
        <div class="card-header card-header-content-md-between">
            <div class="mb-2 mb-md-0 w-100">
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
                            aria-label="Search users"
                            wire:model.debounce.500ms="search"
                        />
                    </div>
                    <!-- End Search -->
                </form>
            </div>
        </div>
        <!-- End Header -->

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
                    <th>Name</th>
                    <th>Status</th>
                    <th></th>
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
                                    <img class="avatar-img" src="{{ $dt->getFileUrl() }}" alt="Image Description">
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">{{ $dt->HouseName }}</span>
                                    <span class="d-block fs-5 text-body">
                                        {{ $dt->address }}
                                    </span>
                                </div>
                            </a>
                        </td>
                        <td>{{ $dt->Status }}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-white btn-sm"
                                wire:click.prevent="$emit('showAdditionalHouseCUModal', true, {{ $dt->HouseID}})"
                            >
                                <i class="bi-pencil-fill"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger btn-sm trash-btn"
                                wire:click.prevent="destroy({{ $dt->HouseID }})"
                            >
                                <i class="bi-trash"></i>
                            </button>
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
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                        {{ $data->links() }}
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
