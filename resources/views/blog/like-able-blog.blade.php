<p class="ps-0">
<a href="#!">
    @if($isExistingUser)
    <img src="/images/blog-images/filled-heart.svg" class="img-fluid me-1">
    @else
        <img src="/images/blog-images/love.png" class="img-fluid me-1" wire:click="likeBlog()">
    @endif
</a>
<span>{{ isset($existing_likes) ? $existing_likes : 0}} Likes</span>
</p>
