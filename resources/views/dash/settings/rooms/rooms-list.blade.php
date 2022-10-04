<div>
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
                            type="search"
                            class="form-control"
                            placeholder="Search by name"
                            aria-label="Search rooms"
                            wire:model.debounce.500ms="search"
                        />
                    </div>
                    <!-- End Search -->
                </form>
            </div>
        </div>
        <!-- End Header -->
        <x-jet-banner/>
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
                    <th>Type</th>
                    <th>Amenities</th>
                    <th>Beds</th>
                    <th>Bed's Type</th>
                    <th>Action</th>
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
                            {{ $dt->RoomName }}
                        </td>
                        <td>
                            {{ $dt->roomType->RoomTypeVal }}
                        </td>
                        <td>{{ implode(', ', $dt->amenities->pluck('Abreviation')->toArray()) }}</td>
                        <td>{{ $dt->Beds }}</td>
                        <td>{{ optional($dt->bedType)->name ?? '-' }}</td>


                        <td>
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-white" href="#"
                                   wire:click.prevent="$emit('showRoomCUModal', true, {{ $dt->RoomID}})"
                                >
                                    <i class="bi-pencil me-1 text-success"></i> Edit
                                </a>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm"
                                    wire:click.prevent="destroy({{$dt->RoomID}})"
                                >
                                    <i class="bi-trash"></i>
                                </button>

                            </div>
                        </td>


{{--                        <td>--}}

{{--                            <button--}}
{{--                                type="button"--}}
{{--                                class="btn btn-white btn-sm"--}}
{{--                                wire:click.prevent="$emit('showRoomCUModal', true, {{ $dt->RoomID}})"--}}
{{--                            >--}}
{{--                                <i class="bi-pencil-fill"></i>--}}
{{--                            </button>--}}

{{--                            <button--}}
{{--                                type="button"--}}
{{--                                class="btn btn-danger btn-sm trash-btn"--}}
{{--                                wire:click.prevent="destroy({{$dt->RoomID}})"--}}
{{--                            >--}}
{{--                                <i class="bi-trash"></i>--}}
{{--                            </button>--}}

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
