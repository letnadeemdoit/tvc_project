<div class="container  pb-5">
    <div class="d-flex justify-content-center justify-content-md-start local-guide-tabs">
        <nav class="navecation mb-3">
            <ul id="navi">
                @if(count($categories) >0)
                <li>
                    <a href="{{ route('guest.local-guide.index', ['category' => 'all']) }}" class="menu {{ $category == 'all' ? 'active' : '' }}">
                        ALL
                    </a>
                </li>
                @endif
                @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('guest.local-guide.index', ['category' => $cat->slug]) }}" class="menu {{ $cat->slug == $category ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

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
