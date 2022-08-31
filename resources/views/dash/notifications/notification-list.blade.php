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
                    <th style="width: 25%">Type</th>
                    <th>Name</th>
                    <th>Slug</th>
                </tr>
                </thead>

                <tbody>

                @if ($data->count() > 0 )
                    @foreach($data as $dt)

                        <tr>
                            <td class="fw-600">

                                @if($dt->type == 'App\Notifications\BlogNotify')
                                    Blog
                                @else
                                    Calendar
                                @endif

                            </td>
                            <td class="fw-600">{{ $dt->data['Name'] ?? '' }}</td>
                            <td class="fw-600">
                                @if(isset($dt->data['slug']))
                                    <a href="{{ $dt->data['slug'] ?? '' }}" target="_blank">Click to Check</a>
                                @else
                                    ---
                                @endif
                            </td>

                        </tr>
                    @endforeach
                @else
                    <p class="dropdown-item">There are no new notifications</p>
                @endif

                </tbody>
            </table>
        </div>
        <!-- End Table -->
    </div>

</div>
