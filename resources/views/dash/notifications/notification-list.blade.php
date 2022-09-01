<div>
    <div class="card">
        <!-- Header -->

        @if ($data->count() > 0 )
{{--        <div class="card-header card-header-content-md-between">--}}
{{--            <div class="mb-2 mb-md-0 w-50">--}}
{{--                <form>--}}
{{--                    <!-- Search -->--}}
{{--                    <div class="input-group input-group-merge input-group-flush">--}}
{{--                        <div class="input-group-prepend input-group-text">--}}
{{--                            <div wire:loading wire:target="search">--}}
{{--                                <div class="spinner-border spinner-border-sm" role="status">--}}
{{--                                    <span class="visually-hidden">Loading...</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <i class="bi-search" wire:loading.remove wire:target="search"></i>--}}
{{--                        </div>--}}
{{--                        <input--}}
{{--                            id="datatableSearch"--}}
{{--                            type="search"--}}
{{--                            class="form-control"--}}
{{--                            placeholder="Search by name"--}}
{{--                            aria-label="Search"--}}
{{--                            wire:model.debounce.500ms="search"--}}
{{--                        />--}}
{{--                    </div>--}}
{{--                    <!-- End Search -->--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- End Header -->

        <!-- Table -->



        <div class="table-responsive datatable-custom">
            <table
                class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                <tr>
                    <th style="width: 25%">Type</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>


                    @foreach($data as $dt)

                        <tr>
                            <td class="fw-600">

                                @if($dt->type == 'App\Notifications\BlogNotify')
                                    Blog
                                @else
                                    Calendar
                                @endif

                            </td>



                            @if($dt->type == 'App\Notifications\BlogNotify')
                                <td class="fw-600">New Blog <span class="text-primary text-capitalize text-decoration-underline">{{ $dt->data['Name'] ?? '' }}</span> Created</td>

                            @else
                                <td class="fw-600">New Vacation Calendar <span class="text-primary text-capitalize text-decoration-underline">{{ $dt->data['Name'] ?? '' }}</span> Created</td>

                            @endif

                            <td class="fw-600">
                                @if(isset($dt->data['slug']))
                                    <a href="{{ $dt->data['slug'] ?? '' }}" target="_blank">Click to Check</a>
                                @else
                                    ---
                                @endif
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    <div class="mt-3">
        {{ $data->links() }}
    </div>

        <!-- End Table -->
    </div>

    @else
        <p class="text-center my-4">There are no Notifications</p>
    @endif

</div>
