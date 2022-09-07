<div class="container  pb-5 pt-5">
    <div class="d-flex justify-content-center justify-content-md-start local-guide-tabs">
        <div class="category-cards mb-3 d-flex scrollbar" style="max-width: 100%">
            @if(count($categories) >0)
                <ul class="nav nav-tabs border-bottom-0 blog-tabs">
                    <li class="nav-item">
                        <a href="{{ route('guest.local-guide.index', ['category' => 'all']) }}" class="nav-link {{ $category == 'all' ? 'active' : '' }}">
                            ALL
                        </a>
                    </li>
                </ul>
                <a
                    class="btn btn-white scroll-icons align-items-center py-2"
                    id="left-button"
                >
                    <i class="bi bi-chevron-left"></i>
                </a>
                <ul class="nav nav-tabs border-bottom-0 blog-tabs mx-1 mx-sm-2 scroll margin-0" id="category-bar" role="tablist" style="overflow-x: scroll">

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
                >
                    <i class="bi bi-chevron-right"></i>
                </a>
            @endif
        </div>
{{--        <div class="category-cards mb-3 d-flex scrollbar" id="category-bar" style="max-width: 100%">--}}

{{--            @if(count($categories) >0)--}}
{{--                <ul class="nav nav-tabs border-bottom-0 blog-tabs">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('guest.local-guide.index', ['category' => 'all']) }}" class="nav-link {{ $category == 'all' ? 'active' : '' }}">--}}
{{--                            ALL--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <a--}}
{{--                    class="btn btn-white scroll-icons align-items-center"--}}
{{--                    id="left-button"--}}
{{--                >--}}
{{--                    <i class="bi bi-chevron-left"></i>--}}
{{--                </a>--}}
{{--                <ul class="nav nav-tabs border-bottom-0 blog-tabs scroll mx-1 mx-sm-2 margin-0" id="myTab" role="tablist">--}}
{{--                    @foreach($categories as $cat)--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{  route('guest.local-guide.index', ['category' => $cat->slug]) }}" class="nav-link {{ $cat->slug == $category ? 'active' : '' }}">--}}
{{--                                {{ $cat->name }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--                <a--}}
{{--                    class="btn btn-white scroll-icons align-items-center"--}}
{{--                    id="right-button"--}}
{{--                >--}}
{{--                    <i class="bi bi-chevron-right"></i>--}}
{{--                </a>--}}
{{--            @endif--}}
{{--        </div>--}}

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
        let w = 0;
        let sw = 0;
        let sp = 0;

        leftBtn.hide();
        rightBtn.hide();

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

            if(w < sw) {
                leftBtn.show();
                rightBtn.show();
            } else {
                leftBtn.hide();
                rightBtn.hide();
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
