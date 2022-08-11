

<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="row mt-5">

        @foreach($blogs as $blog)
            @include('livewire.blog.blog-cards.blog-item-card')
        @endforeach

    </div>
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

                    <span class="text-secondary me-2">{{ $blogs->currentPage() }}</span>
                    <span class="text-secondary me-2">of</span>

                    <!-- Pagination Quantity -->
                    <span id="datatableWithPaginationInfoTotalQty">{{ $blogs->lastPage() }}</span>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-sm-auto pt-2">
                <div class="table-responsive d-flex align-items-center justify-content-center justify-content-sm-end">
                    <!-- Pagination -->
                    {{ $blogs->links() }}
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
{{--        {{ $blogs->withQueryString()->onEachSide(2)->links() }}--}}
    </div>
</div>


