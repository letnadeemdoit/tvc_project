<div class="container  pb-5 pt-5">
    <div class="d-flex justify-content-center justify-content-md-start local-guide-tabs" id="scroller">
        @if(count($categories) >0)
            <div class="category-cards mb-3 d-flex scrollbar" style="max-width: 100%">
                <ul class="nav nav-tabs border-bottom-0 blog-tabs">
                    <li class="nav-item">
                        <a href="{{ route('guest.local-guide.index', ['category' => 'all']) }}" class="nav-link {{ $category == 'all' ? 'active' : '' }}" id="all-btn">
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
                            <a href="{{ route('guest.local-guide.index', ['category' => $cat->slug]) }}" class="nav-link {{ $cat->slug == $category ? 'active' : '' }}">
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
        </div>
        @endif

    </div>
    <div class="row mt-5">
        @if(isset($data))
            @foreach($data as $dt)
                <livewire:local-guide.post-card :dt="$dt" wire:key="{{ $dt->id }}"/>
            @endforeach
        @endif
    </div>

    @if(isset($data) && count($data) >6 )
        <div class="text-center pt-5 padding-bottom">
            <a class="btn btn-lg btn-soft-primary px-5" id="next">See more</a>
        </div>
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
