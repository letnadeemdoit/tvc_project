<div class="pt-55  category-cards">

    <div class="d-flex justify-content-center justify-content-md-start ms-0 ms-md-3" id="scroller">
        <div class="category-cards mb-3 d-flex scrollbar" style="max-width: 100%">
            @if(count($categories) >0)
                <ul class="nav nav-tabs border-bottom-0 blog-tabs">
                    <li class="nav-item">
                        <a href="{{ route('guest.bulletin-board.index', ['category' => 'all']) }}" class="nav-link {{ $category == 'all' ? 'active' : '' }}" id="all-btn">
                            ALL
                        </a>
                    </li>
                </ul>
                <a
                    class="btn btn-white scroll-icons align-items-center py-2"
                    id="left-button"
                    style="display: none"
                >
                    <i class="bi bi-chevron-left align-items-center d-flex h-100"></i>
                </a>
                <ul class="nav nav-tabs border-bottom-0 blog-tabs mx-1 mx-sm-2 scroll margin-0" id="category-bar" role="tablist">

                    @foreach($categories as $cat)
                        <li class="nav-item">
                            <a href="{{ route('guest.bulletin-board.index', ['category' => $cat->slug]) }}" class="nav-link {{ $cat->slug == $category ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a
                    class="btn btn-white scroll-icons align-items-center"
                    id="right-button"
                    style="display: none"
                >
                    <i class="bi bi-chevron-right align-items-center d-flex h-100"></i>
                </a>
            @endif
        </div>

    </div>


    <!-- dots img -->

    <div class="tab-content bg-waves" id="myTabContent" style="background-image: url('/images/bulletin-images/combined-shape.png');
    background-repeat: no-repeat;
    background-size: auto;
    background-position: top right 150px;">
        <div class="container padding-bottom massonary-container">
            <div class="masonry tab-pane fade show active pt-5 pb-4" style="background-image:url('/images/bulletin-images/dark-dots.png'); background-repeat:no-repeat;background-position: center bottom;">
                @foreach($data as $dt)
                    <livewire:bulletin-board.board-item-card :dt="$dt" wire:key="{{ $dt->id }}"/>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...
        </div>
        <div class="tab-pane fade" id="shopping" role="tabpanel" aria-labelledby="shopping-tab">...
        </div>
        <div class="tab-pane fade" id="clipboard" role="tabpanel" aria-labelledby="clipboard-tab">
            ...
        </div>
        <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
            ...
        </div>
    </div>
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
                $('#all-btn').css('margin-right','7px');
            }
        }

        $(function (){
            recalculateCategoriesWidth();
            $(window).resize(function() {
                recalculateCategoriesWidth();
            });
        });
    </script>
@endpush
