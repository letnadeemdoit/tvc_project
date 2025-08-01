<x-guest-layout>
    @push('stylesheets')

    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Photo Album'])

    <section>
        <div class="section-padding">
            <div class="bg-album shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
                <h1 class="text-primary font-vintage mb-0">Photo Album</h1>
            </div>
            <h1 class="pt-2 text-center poppins-bold">Share discoveries with community</h1>
        </div>
        <div class="container padding-bottom">
            <div class="row">
                @foreach($nestedAlbums as $dt)
                    <div class="col-md-4" style="">
                        <div class="card mb-3 shadow-lg" style="min-height: 450px">
                            <img class="card-img-top" src="{{ $dt->getFileUrl() }}" alt="Card image cap"  style="max-height:350px">

{{--                            <img class="card-img-top" src="{{asset('/images/photo-album/album-detail.svg')}}" alt="Card image cap">--}}
                            <div class="card-body">
                                <h3 class="card-title">{{ $dt->name }}</h3>
                                <p class="card-text">{!! $dt->description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

</x-guest-layout>
