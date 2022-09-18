<div>
    <a href="#!" wire:click.prevent="likeBlog()">
            @if($isExistingUser)
                <img src="/images/blog-images/filled-heart.svg" class="img-fluid me-1">
            @else
                <img src="/images/blog-images/love.svg" class="img-fluid me-1" >
            @endif
                <span  class="text-footer-color">{{ isset($existing_likes) ? $existing_likes : 0}} Likes</span>
    </a>
</div>
