<div class="container pt-55">
      @if(isset($data))
        <div class="category-cards mb-3">
            <ul class="nav nav-tabs border-bottom-0 blog-tabs" id="myTab" role="tablist">
                @if(count($categories) >0)
                    <li class="nav-item">
                        <a href="{{ route('guest.blog.index', ['category' => 'all']) }}" class="nav-link {{ $category == 'all' ? 'active' : '' }}">
                            ALL
                        </a>
                    </li>
                @endif
                @foreach($categories as $cat)
                    <li class="nav-item">
                        <a href="{{ route('guest.blog.index', ['category' => $cat->slug]) }}" class="nav-link {{ $cat->slug == $category ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="row category-cards">
            @foreach($data as $dt)
                <livewire:blog.post-card :post="$dt" wire:key="{{ $dt->BlogId }}"/>
            @endforeach

    </div>

        @if(isset($data) && count($data) >12 )
            <div class="text-center pt-5 padding-bottom">
                <a class="btn btn-lg btn-soft-primary px-5" id="next">See more</a>
            </div>
        @endif

    @else
        @include('partials.no-data-available',['title' => 'Blog'])
  @endif

</div>
