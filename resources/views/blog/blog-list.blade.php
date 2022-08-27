<div class="container pt-55">
    <div class="category-cards mb-3">
        <ul class="nav nav-tabs border-bottom-0 blog-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a href="{{ route('guest.blog.index', ['category' => 'all']) }}" class="nav-link {{ $category == 'all' ? 'active' : '' }}">
                    ALL
                </a>
            </li>
            @foreach($categories as $cat)
                <li class="nav-item">
                    <a href="{{ route('guest.blog.index', ['category' => $cat->slug]) }}" class="nav-link {{ $cat->slug == $category ? 'active' : '' }}">
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
                        {{ $cat->name }}
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

    @if(isset($data) && count($data) >6 )
        <div class="text-center pt-5 padding-bottom">
            <a class="btn btn-lg btn-soft-primary px-5" id="next">See more</a>
        </div>
    @endif
        <!-- End Row -->



</div>
