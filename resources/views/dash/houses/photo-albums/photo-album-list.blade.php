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
                            placeholder="Search by name"
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
                    <th>House</th>
                    <th style="max-width: 400px">Name &amp; DESCRIPTION</th>
                    <th>Parent Album</th>
{{--                    <th>Description</th>--}}
                    <th>Photos</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($data as $dt)
                    <tr>
                        <td style="width: 100px" class="text-center">
                            <div class="avatar avatar-soft-primary avatar-circle">
                                <img
                                    src="{{$dt->getThumbnailUrl(\App\Models\Photo\Album::$THUMBNAIL_SMALL)}}"
                                    class="avatar-initials"
                                    alt="{{ $dt->name ?? '' }}"
                                />
                            </div>

                        </td>
                        <td class="fw-600">{{ auth()->user()->house->HouseName ?? ''}}</td>
                        <td style="max-width: 400px" class="text-wrap text-break" ><h5 class="mb-0">{{$dt->name ?? ''}}</h5>
                                <small class="mb-0">{!! substr($dt->description,0,255) ?? '' !!}</small>
                        </td>
                        <td>{{$dt->parentAlbum->name ?? ''}}</td>
{{--                        <td>{!! substr($dt->description,0,40) ?? '' !!}--}}

{{--                            @if(isset($dt->description) && strlen($dt->description) >= 40)--}}
{{--                                <a href="#!"--}}
{{--                                   class="fw-600"--}}
{{--                                   data-bs-toggle="modal"--}}
{{--                                   data-bs-target="#localGuideDescription{{$dt->id}}Details"--}}
{{--                                >View</a>--}}
{{--                            @endif--}}

{{--                        </td>--}}

                        <!-- Modal -->
                        <div class="modal fade" id="localGuideDescription{{$dt->id}}Details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$dt->name ?? ''}}'s Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            {!! $dt->description ?? '' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <td>
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-primary"
                                   href="{{route('dash.photo-albums.photos',$dt->id)}}"
                                >
                                    Photos <i class="bi-arrow-right me-1 text-white"></i>
                                </a>
                            </div>
                        </td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-white" href="#"
                                   wire:click="$emit('showAlbumCUModal', true, {{$dt->id}})"
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
