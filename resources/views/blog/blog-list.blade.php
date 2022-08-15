<div class="container pt-5">
    <div class="category-cards mb-3">
        <ul class="nav nav-tabs border-bottom-0 blog-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a href="3" class="nav-link active">
                    ALL
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <img src="/images/blog-images/beach.svg" width="30px" class="me-2 d-none d-md-inline-block"/> BEACH
                    HOUSE
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <img src="/images/blog-images/building-house.svg" width="30px"
                         class="me-2 d-none d-md-inline-block"/>TOWN
                    HOUSE
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <img src="/images/blog-images/tiny-house.svg" width="30px" class="me-2 d-none d-md-inline-block"/>TINY
                    HOUSE
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <img src="/images/blog-images/pool.svg" width="30px" class="me-2 d-none d-md-inline-block"/>POOL
                    HOUSE
                </a>
            </li>
        </ul>
    </div>
    <div class="row category-cards">
        @foreach($data as $dt)
            <livewire:blog.post-card :post="$dt"/>
        @endforeach

    </div>

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

                    <span class="text-secondary ms-2 me-2">{{ $data->currentPage() }}</span>
                    <span class="text-secondary me-2">of</span>

                    <!-- Pagination Quantity -->
                    <span id="datatableWithPaginationInfoTotalQty">{{ $data->lastPage() }}</span>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-sm-auto pt-2">
                <div class="table-responsive d-flex align-items-center justify-content-center justify-content-sm-end">
                    <!-- Pagination -->
                    {{ $data->links() }}
                </div>
            </div>
            <!-- End Col -->
    </div>
        <!-- End Row -->



</div>
