

<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="row mt-5">

        @foreach($blogs as $blog)
            @include('livewire.blog.blog-cards.blog-item-card')
        @endforeach

    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-6 mx-auto">{{ $blogs->links() }}</div>
        </div>
{{--        {{ $blogs->withQueryString()->onEachSide(2)->links() }}--}}
    </div>
</div>


