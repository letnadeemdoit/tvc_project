
<x-guest-layout>
    @push('stylesheets')

    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'House Blog'])

    {{--  center text row  --}}
    <section class="bg-map bg-light pt-5">
        <div class="blog-text shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">House Blog</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Read the best stories here</h1>
        <div class="container  pt-5">
            <div class="row my-5  category-cards">
                <div class="col-12">
                    <ul class="nav nav-tabs border-bottom-0 blog-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">
                                ALL
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="true">
                                <img src="/images/blog-images/beach.svg" width="30px" class="me-2 d-none d-md-inline-block" />Awesome finds
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact" aria-selected="true">
                                <img src="/images/blog-images/cool.svg" width="30px" class="me-2 d-none d-md-inline-block" />Cool Stuff
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shopping-tab" data-bs-toggle="tab"
                                    data-bs-target="#shopping" type="button" role="tab" aria-controls="shopping"
                                    aria-selected="true">
                                <img src="/images/blog-images/tips.svg" width="30px" class="me-2 d-none d-md-inline-block" />Fun Tips
                            </button>
                        </li>
                    </ul>
                    <!-- dots img -->
                    @include('flash-messages')
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @livewire('blog.blog-cards.blogs')
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...
                            ...
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

            </div>
        </div>
    </section>

</x-guest-layout>

@pushonce('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            window.livewire.on('hideModal', (reload = false) => {
                $('.hideableModal').each(function () {
                    $(this).modal('hide');
                });
                if (reload) {
                    window.location.reload();
                } else {
                    $('.modal-backdrop').remove();
                    $('body').css('overflow', '');
                    $('body').css('padding-right', '');
                    $('body').removeClass('modal-open');
                }
            });
        });
    </script>
@endpushonce

