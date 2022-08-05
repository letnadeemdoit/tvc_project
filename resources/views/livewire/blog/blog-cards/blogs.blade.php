

<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="row">

        @foreach($blogs as $blog)
            @include('livewire.blog.blog-cards.blog-item-card')
        @endforeach

    </div>
    <div class="d-flex">
        {!! $blogs->links() !!}
    </div>
</div>


