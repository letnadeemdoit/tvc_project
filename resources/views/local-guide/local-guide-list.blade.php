<div class="container  pb-5 pt-5">
    <div class="d-flex justify-content-center justify-content-md-start local-guide-tabs">
        <div class="category-cards mb-3 d-flex scrollbar" id="category-bar">
            @if(count($categories) >0)
                <ul class="nav nav-tabs border-bottom-0 blog-tabs">
                    <li class="nav-item">
                        <a href="{{ route('guest.local-guide.index', ['category' => 'all']) }}" class="nav-link {{ $category == 'all' ? 'active' : '' }}">
                            ALL
                        </a>
                    </li>
                </ul>
                <a
                    type="button"
                    class="btn btn-white scroll-icons align-items-center"
                    id="left-button"
                >
                    <i class="bi bi-chevron-left"></i>
                </a>
                <ul class="nav nav-tabs border-bottom-0 blog-tabs scroll mx-1 mx-sm-2 margin-0" id="myTab" role="tablist">
                    @foreach($categories as $cat)
                        <li class="nav-item">
                            <a href="{{  route('guest.local-guide.index', ['category' => $cat->slug]) }}" class="nav-link {{ $cat->slug == $category ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a
                    type="button"
                    class="btn btn-white scroll-icons align-items-center"
                    id="right-button"
                >
                    <i class="bi bi-chevron-right"></i>
                </a>
            @endif
        </div>
{{--        <nav class="navecation mb-3">--}}
{{--            <ul id="navi">--}}
{{--                @if(count($categories) > 0)--}}
{{--                <li>--}}
{{--                    <a href="{{ route('guest.local-guide.index', ['category' => 'all']) }}" class="menu mb-2 {{ $category == 'all' ? 'active' : '' }}">--}}
{{--                        ALL--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endif--}}
{{--                @foreach($categories as $cat)--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('guest.local-guide.index', ['category' => $cat->slug]) }}" class="menu mb-2 {{ $cat->slug == $category ? 'active' : '' }}">--}}
{{--                            {{ $cat->name ?? '' }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </nav>--}}

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
        $('#right-button').click(function() {
            event.preventDefault();
            $('#myTab').animate({
                scrollLeft: "+=100px"
            }, "slow");
        });

        $('#left-button').click(function() {
            event.preventDefault();
            $('#myTab').animate({
                scrollLeft: "-=100px"
            }, "slow");
        });

    </script>
    <script>
        $('#left-button').hide();
        $('#right-button').hide();

        let elementwidth = $('#category-bar').text().length;
        console.log(elementwidth);
        if(elementwidth > 1980){
            console.log("elementwidth");
            $('#left-button').show();
            $('#right-button').show();
        }
    </script>
@endpush
