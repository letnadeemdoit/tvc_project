<div class="container pt-55">
    <div class="category-cards mb-3">
        <ul class="nav nav-tabs border-bottom-0 blog-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a href="{{ route('guest.blog.index', ['category' => 'all']) }}" class="nav-link active">
                    ALL
                </a>
            </li>
            @foreach($categories as $category)
                <li class="nav-item">
                    <a href="{{ route('guest.blog.index', ['category' => $category->slug]) }}" class="nav-link">
{{--                        @if($category->image)--}}
{{--                            <img--}}
{{--                                src="{{$category->getFileUrl('image')}}"--}}
{{--                                class="avatar-initials me-2 d-none d-md-inline-block"--}}
{{--                                width="30px"--}}
{{--                                alt="img"--}}
{{--                            />--}}
{{--                        @else--}}
{{--                            <img src="/images/blog-images/beach.svg" width="30px" class="me-2 d-none d-md-inline-block"/>--}}
{{--                        @endif--}}
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
{{--        <livewire:blog.blog-categories />--}}
    </div>
    <div class="row category-cards">
        @foreach($data as $dt)
            <livewire:blog.post-card :post="$dt" wire:key="{{ $dt->BlogId }}"/>
        @endforeach

    </div>

    <div class="row justify-content-center justify-content-sm-between align-items-sm-center pt-3">
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
                <div class="table-responsive d-flex align-items-center justify-content-center justify-content-sm-end my-3">
                    <!-- Pagination -->
                    {{ $data->links() }}
                </div>
            </div>
            <!-- End Col -->
    </div>
        <!-- End Row -->



</div>
