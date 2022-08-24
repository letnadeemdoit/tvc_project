<div class="mt-5  category-cards">


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
                <li class="menu active">
                    <a href="{{ route('guest.bulletin-board.index', ['category' => 'all']) }}">
                        ALL
                    </a>
                </li>
                @foreach($categories as $category)
                    <li class="menu">
                        <a href="{{ route('guest.bulletin-board.index', ['category' => $category->slug]) }}" class="nav-link">
{{--                            @if($category->image)--}}
{{--                                <img--}}
{{--                                    src="{{$category->getFileUrl('image')}}"--}}
{{--                                    class="me-2 d-none d-md-inline-block"--}}
{{--                                    alt="img"--}}
{{--                                />--}}
{{--                            @else--}}
{{--                                <img src="/images/blog-images/beach.svg" width="30px" class="me-2 d-none d-md-inline-block"/>--}}
{{--                            @endif--}}
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

    </div>


    <!-- dots img -->

    <div class="tab-content bg-waves" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <section class="text-end">
                <img src="/images/bulletin-images/orange-dots" class="img-fluid bg-dots-orange"/>
            </section>
            <div class="row" data-masonry='{"percentPosition": true }'>
                    @foreach($data as $dt)
                    <livewire:bulletin-board.board-item-card :dt="$dt" wire:key="{{ $dt->id }}"/>
                    @endforeach
                    <!-- ends -->
                <section class="text-center">
                    <img src="/images/bulletin-images/dark-dots.png" class="img-fluid cards-dots-green"/>
                </section>
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
