<x-guest-layout>
    @push('stylesheets')

    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Photo Album'])

    <section class="bg-light">
        <div class="section-padding">
            <div class="bg-album shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
                <h1 class="text-primary font-vintage mb-0">Photo Album</h1>
            </div>
            <h1 class="pt-2 text-center poppins-bold">Share discoveries with community</h1>
        </div>
        <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3 shadow-lg">
                    <img class="card-img-top" src="{{asset('/images/photo-album/album-detail.svg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h3 class="card-title">Card title</h3>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 shadow-lg">
                    <img class="card-img-top" src="{{asset('/images/photo-album/album-detail.svg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h3 class="card-title">Card title</h3>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 shadow-lg">
                    <img class="card-img-top" src="{{asset('/images/photo-album/album-detail.svg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h3 class="card-title">Card title</h3>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

</x-guest-layout>
