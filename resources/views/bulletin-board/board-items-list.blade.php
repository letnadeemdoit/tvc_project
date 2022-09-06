<div class="pt-55  category-cards">

    <div class="d-flex justify-content-center justify-content-md-start ms-0 ms-md-3">
        <div class="category-cards mb-3 d-flex scrollbar" id="category-bar" style="max-width: 100%">
            @if(count($categories) >0)
                <ul class="nav nav-tabs border-bottom-0 blog-tabs">
                    <li class="nav-item">
                        <a href="{{  route('guest.bulletin-board.index', ['category' => 'all']) }}" class="nav-link {{ $category == 'all' ? 'active' : '' }}">
                            ALL
                        </a>
                    </li>
                </ul>
                <a
                    class="btn btn-white scroll-icons align-items-center d-flex"
                    id="left-button"
                >
                    <i class="bi bi-chevron-left"></i>
                </a>
                <ul class="nav nav-tabs border-bottom-0 blog-tabs scroll mx-1 mx-sm-2 margin-0" id="myTab" role="tablist">
                    @foreach($categories as $cat)
                        <li class="nav-item">
                            <a href="{{  route('guest.bulletin-board.index', ['category' => $cat->slug]) }}" class="nav-link {{ $cat->slug == $category ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a
                    class="btn btn-white scroll-icons align-items-center d-flex"
                    id="right-button"
                >
                    <i class="bi bi-chevron-right"></i>
                </a>
            @endif
        </div>
{{--        <nav class="navecation mb-3">--}}
{{--            <ul id="navi">--}}
{{--                @if(count($categories) >0)--}}
{{--                <li class="menu">--}}
{{--                    <a href="{{ route('guest.bulletin-board.index', ['category' => 'all']) }}" class="nav-link {{$category == 'all' ? 'active' : ''}}">--}}
{{--                        ALL--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endif--}}
{{--                @foreach($categories as $cat)--}}
{{--                    <li class="menu">--}}
{{--                        <a href="{{ route('guest.bulletin-board.index', ['category' => $cat->slug]) }}" class="nav-link {{$cat->slug == $category ? 'active' : ''}}">--}}
{{--                            @if($category->image)--}}
{{--                                <img--}}
{{--                                    src="{{$category->getFileUrl('image')}}"--}}
{{--                                    class="me-2 d-none d-md-inline-block"--}}
{{--                                    alt="img"--}}
{{--                                />--}}
{{--                            @else--}}
{{--                                <img src="/images/blog-images/beach.svg" width="30px" class="me-2 d-none d-md-inline-block"/>--}}
{{--                            @endif--}}
{{--                            {{ $cat->name }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </nav>--}}

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
