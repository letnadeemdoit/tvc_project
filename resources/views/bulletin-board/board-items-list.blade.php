<div class="pt-55  category-cards">


    {{--                <ul class="nav nav-tabs border-bottom-0" id="myTab" role="tablist">--}}
    {{--                    <li class="nav-item" role="presentation">--}}
    {{--                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"--}}
    {{--                                data-bs-target="#home" type="button" role="tab" aria-controls="home"--}}
    {{--                                aria-selected="true">--}}
    {{--                            <img src="/images/bulletin-images/bulletin-clipboard.svg" width="30px"/>--}}
    {{--                        </button>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}


    <div class="d-flex justify-content-center justify-content-md-start">
        <nav class="navecation mb-3">
            <ul id="navi">
                @if(count($categories) >0)
                <li class="menu">
                    <a href="{{ route('guest.bulletin-board.index', ['category' => 'all']) }}" class="nav-link {{$category == 'all' ? 'active' : ''}}">
                        ALL
                    </a>
                </li>
                @endif
                @foreach($categories as $cat)
                    <li class="menu">
                        <a href="{{ route('guest.bulletin-board.index', ['category' => $cat->slug]) }}" class="nav-link {{$cat->slug == $category ? 'active' : ''}}">
{{--                            @if($category->image)--}}
{{--                                <img--}}
{{--                                    src="{{$category->getFileUrl('image')}}"--}}
{{--                                    class="me-2 d-none d-md-inline-block"--}}
{{--                                    alt="img"--}}
{{--                                />--}}
{{--                            @else--}}
{{--                                <img src="/images/blog-images/beach.svg" width="30px" class="me-2 d-none d-md-inline-block"/>--}}
{{--                            @endif--}}
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

    </div>


    <!-- dots img -->

    <div class="tab-content bg-waves" id="myTabContent" style="background-image: url('/images/bulletin-images/combined-shape.png');
    background-repeat: no-repeat;
    background-size: auto;
    background-position: top right;">
{{--        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">--}}

{{--            <div class="row"  style="background-image:url('/images/bulletin-images/dark-dots.png'); background-repeat:no-repeat;background-position: center bottom;">--}}
{{--                    @foreach($data as $dt)--}}
{{--                    <livewire:bulletin-board.board-item-card :dt="$dt" wire:key="{{ $dt->id }}"/>--}}
{{--                    @endforeach--}}

{{--            </div>--}}

{{--        </div>--}}
        <div class="container padding-bottom massonary-container">
            <div class="masonry tab-pane fade show active" style="background-image:url('/images/bulletin-images/dark-dots.png'); background-repeat:no-repeat;background-position: center bottom;">
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
