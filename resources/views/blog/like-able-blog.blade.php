<p class="ps-0">

    @if(!auth()->user()->is_guest)
        <a href="#!">
            @if($isExistingUser)
                <img src="/images/blog-images/filled-heart.svg" class="img-fluid me-1" wire:click="likeBlog()">
            @else
                <img src="/images/blog-images/love.svg" class="img-fluid me-1" wire:click="likeBlog()">
            @endif
        </a>
    @endif
<span>{{ isset($existing_likes) ? $existing_likes : 0}} Likes</span>
</p>
