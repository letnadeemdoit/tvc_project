<div>
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
                            placeholder="Search by title"
                            aria-label="Search"
                            wire:model.debounce.500ms="search"
                        />
                    </div>
                    <!-- End Search -->
                </form>
            </div>
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <table
                class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                <tr>
                    <th style="width: 100px" class="text-center">Image</th>
{{--                    <th>Category</th>--}}
                    <th>Title</th>
                    <th>Created by</th>
{{--                    <th>Description</th>--}}
                    <th>Address</th>
                    <th>Date Time</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($data as $dt)
                    <tr>
                        <td style="width: 100px" class="text-center">
                            <div class="avatar avatar-soft-primary avatar-circle">
                                <img
                                  @if(isset($dt->image))
                                    src="{{$dt->getFileUrl('image')}}"
                                  @else
                                    src="{{ $dt->user->house->getFileUrl() }}"
                                  @endif
                                    class="avatar-initials"
                                    alt="{{ $dt->title ?? '' }}"
                                />
                            </div>

                        </td>
{{--                        <td class="fw-600">{{$dt->localGuideCategory->name ?? ''}}</td>--}}
                        <td>{{$dt->title ?? ''}}</td>
                        <td>
                            {{$dt->user->first_name ?? ''}}  {{$dt->user->last_name ?? ''}}
                            <small class="fs-10">({{$dt->user->role ?? ''}})</small>
                        </td>
{{--                        <td>{!! substr($dt->description,0,30) ?? '' !!}--}}

{{--                           @if(isset($dt->description) && strlen($dt->description) > 41)--}}
{{--                                <a href="#!"--}}
{{--                                   class="fw-600"--}}
{{--                                   data-bs-toggle="modal"--}}
{{--                                   data-bs-target="#localGuideDescription{{$dt->id}}Details"--}}
{{--                                >View</a>--}}
{{--                           @endif--}}

{{--                        </td>--}}

                        <!-- Modal -->
{{--                        <div class="modal fade" id="localGuideDescription{{$dt->id}}Details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                            <div class="modal-dialog modal-dialog-centered">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h5 class="modal-title" id="exampleModalLabel">{{$dt->title ?? ''}}'s Details</h5>--}}
{{--                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body">--}}
{{--                                      <div>--}}
{{--                                          {!! $dt->description ?? '' !!}--}}
{{--                                      </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}


                        <td>{{$dt->address ?? ''}}</td>
                        <td>{{$dt->datetime ?? ''}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-white" href="#"
                                   wire:click="$emit('showLocalGuideCUModal', true, {{$dt->id}})"
                                >
                                    <i class="bi-pencil me-1 text-success"></i> Edit
                                </a>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm"
                                    wire:click.prevent="destroy({{$dt->id}})"
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

</div>
