<div>
    <div class="card">
        <!-- Header -->
        <div class="card-header card-header-content-md-between">
            <div class="mb-2 mb-md-0 w-50">
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
                            placeholder="Search by user"
                            aria-label="Search boards"
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
                    <th>id</th>
                    <th>User</th>
                    <th>Type</th>
                    <th>IP</th>
                    <th>Event</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>

                @foreach($data as $dt)

{{--                    @dd($dt->getMetadata())--}}

                    <tr>
                        <td>{{$dt->id}}</td>
                        <td>{{$dt->user->user_name}}</td>
                        @if(!is_null($dt->auditable))
                            <td>{{str_replace('_',' ', str($dt->auditable->getTable())->title())}}</td>
                        @else
                            <td>---</td>
                        @endif

{{--                        <td>{{$dt->user_type}}</td>--}}
                        <td>{{$dt->ip_address}}</td>
                        <td>{{$dt->event}}</td>
                        <td>{{$dt->created_at}}</td>
                        <td><a href="#!"
                               class="btn btn-sm btn-primary"
                               data-bs-toggle="modal"
                               data-bs-target="#auditHistory{{$dt->id}}Model"
                            >View</a>
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="auditHistory{{$dt->id}}Model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header align-items-start">
                                        <div class="">
                                            <h3 class="modal-title mb-1">
                                                {{$dt->user->user_name}}
                                            </h3>
                                            <small class="mb-0 text-muted d-block">{{$dt->url}}</small>
                                            <small class="mb-0 text-muted">{{$dt->user_agent}}</small>
                                        </div>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Metadata:</h3>
                                        <p>On {{ $dt->getMetadata()['audit_created_at'] }}, {{ $dt->user->user_name }} [{{ $dt->getMetadata()['audit_ip_address'] }}] updated this record via {{ $dt->getMetadata()['audit_url'] }}</p>
                                        <ol>
                                            @foreach ($dt->getModified() as $attribute => $modified)
                                                <li>The {{ $attribute }} has been modified from <strong>{{ $modified['old'] ?? '' }}</strong> to <strong>{{ $modified['new'] ?? ''}}</strong></li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

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

</div>
