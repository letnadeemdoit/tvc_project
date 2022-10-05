<div class="pt-55 category-cards">

    <div class="d-flex justify-content-center justify-content-md-start mb-3 mb-md-0" id="scroller">
        <div class="category-cards  d-flex pt-5 scrollbar" style="max-width: 100%">
            @if(count($categories) >0)
                <ul class="nav nav-tabs border-bottom-0 blog-tabs">
                    <li class="nav-item">
                        <a href="{{ route('guest.bulletin-board.index', ['category' => 'all']) }}"
                           wire:click.prevent="$set('category', 'all')"
                           class="nav-link mr-7px {{ $category == 'all' ? 'active' : '' }}" id="all-btn">
                            ALL
                        </a>
                    </li>
                </ul>
                <a
                    class="btn btn-white scroll-icons align-items-center py-2 ms-0 ms-md-1 ms-lg-2"
                    id="left-button"
                    style="display: none"
                >
                    <i class="bi bi-chevron-left align-items-center d-flex h-100"></i>
                </a>
                <ul class="nav nav-tabs border-bottom-0 blog-tabs mx-1 mx-sm-2 scroll margin-0" id="category-bar" role="tablist">

                    @foreach($categories as $cat)
                        <li class="nav-item">
                            <a href="{{ route('guest.bulletin-board.index', ['category' => $cat->slug]) }}"
                               wire:click.prevent="$set('category', '{{ $cat->slug }}')"
                               class="nav-link {{ $cat->slug == $category ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a
                    class="btn btn-white scroll-icons align-items-center me-2"
                    id="right-button"
                    style="display: none"
                >
                    <i class="bi bi-chevron-right align-items-center d-flex h-100"></i>
                </a>
            @endif
        </div>


    </div>
    <div class="dropdown text-end mb-4">
        Order By:
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 160px;">
            {{$sort_order == 'desc' ? 'Newest' : 'Oldest'}}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <li><a class="dropdown-item {{ $sort_order == 'desc' ? 'active' : ''}}"
                   href="{{route('guest.bulletin-board.index', ['sort_order' => 'desc'])}}"
                   wire:click.prevent="$set('sort_order', 'desc')"
                >
                    Newest</a>
            </li>
            <li><a class="dropdown-item {{ $sort_order == 'asc' ? 'active' : ''}}"
                   href="{{route('guest.bulletin-board.index', ['sort_order' => 'asc'])}}"
                   wire:click.prevent="$set('sort_order', 'asc')"
                >
                    Oldest</a>
            </li>
        </ul>
    </div>

    <!-- dots img -->
    @if(isset($data) && count($data) > 0)
        <div class="bg-waves" style="background-image: url('/images/bulletin-images/combined-shape.png'); background-repeat: no-repeat; background-size: auto; background-position: top right 150px;">
        <div class="padding-bottom massonary-container">
            <div class="masonry pt-3 pb-4" style="background-image:url('/images/bulletin-images/dark-dots.png'); background-repeat:no-repeat;background-position: center bottom;">
                @foreach($data as $dt)
                    <div class="brick  pe-md-1 ">
                        <livewire:bulletin-board.board-item-card :dt="$dt" wire:key="{{ $dt->id }}"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
        @include('partials.no-data-available',['title' => 'No Bulletin Boards have been created yet!'])
    @endif
</div>

@push('scripts')
    <script>
        let leftBtn = $('#left-button');
        let rightBtn = $('#right-button');
        let categories = $('#category-bar');
        let scroller = $('#scroller')
        let w = 0;
        let sw = 0;
        let sp = 0;
        let scr = 0;

        leftBtn.on('click', function (e) {
            e.preventDefault();
            sp -= 100;

            if(sp < 0) sp = 0;
            categories.animate({
                scrollLeft: `${sp}px`
            });
        });

        rightBtn.on('click', function (e) {
            e.preventDefault();
            let slih = categories.scrollLeft() + categories.innerHeight();
            sw = categories.prop("scrollWidth");
            sp += 100;

            if(sp > slih) sp = slih;

            categories.animate({
                scrollLeft: `${sp}px`
            });
        });

        function recalculateCategoriesWidth() {
            w = categories.width();
            sw = categories.prop("scrollWidth");
            scr = scroller.width()-70;
            if(sw > scr) {
                leftBtn.show();
                rightBtn.show();
            } else {
                // $('#all-btn').css('margin-right','7px');
            }
        }

        $(function (){
            recalculateCategoriesWidth();
            $(window).resize(function() {
                recalculateCategoriesWidth();
            });
        });

        document.addEventListener('recalculateCategoriesWidth', function () {
            recalculateCategoriesWidth();
        });
    </script>
@endpush
